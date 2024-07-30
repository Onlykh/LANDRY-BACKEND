<?php

namespace App\Services\AuthServices;

use App\Exceptions\RateLimitException;
use App\Services\AuthServices\AuthServiceInterface;
use App\Models\User;
use App\Services\SmsGatewayServices\SmsGatewayService;
use App\Services\UserServices\UserService;
use Illuminate\Support\Facades\RateLimiter;

class AuthService implements AuthServiceInterface
{
    const INITIAL_DECAY_SECONDS = 35;
    const FIRST_INCREMENT_SECONDS = 300; // 5 minutes
    const SECOND_INCREMENT_SECONDS = 1800; // 30 minutes
    const THIRD_INCREMENT_SECONDS = 86400; // 24 hours

    public function __construct(private UserService $userService)
    {
    }

    public function findUserOrCreateAndSendOtp(array $credentials): User
    {
        $user = $this->userService->getUserByPhoneNumber($credentials['phone_number']);

        if (!$user) {
            $user = $this->userService->create($credentials);
        }

        AuthService::checkOtpRateLimit($user);

        AuthService::sendOtpCode($user);

        return $user;
    }
    public function verifyOtp(string $phoneNumber, string $otp): User
    {
        $user = $this->userService->getUserByPhoneNumber($phoneNumber);

        if ($user->code != $otp) {
            throw new \Exception('Invalid OTP');
        }

        // $user->code = null;
        $user->phone_verified_at = now();
        $user->save();

        return $user;
    }
    static function createToken(User $user, string $tokenName)
    {
        return $user->createToken($tokenName);
    }
    static function refreshToken(User $user, string $tokenName)
    {
        // revoke the current token
        AuthService::revokeToken($user);
        // create a new token
        return $user->createToken($tokenName);
    }
    static function revokeToken(User $user, bool $all = false): bool
    {
        if ($all) {
            return $user->tokens()->delete();
        }
        return $user->tokens()->where('id', auth()->id())->delete();
    }

    static function checkOtpRateLimit(User $user)
    {
        $key = "otp_rate_limit_$user->identifier";
        $maxAttempts = 1;

        // Get the number of attempts
        RateLimiter::attempts($key);

        $decaySeconds = AuthService::calculateDecayTime($user->otp_attempts);

        // Calculate decay time based on the number of attempts
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $retryAfter = RateLimiter::availableIn($key);
            throw new RateLimitException($retryAfter);
        }

        RateLimiter::hit($key, $decaySeconds);
        return true;
    }

    static function sendOtpCode($user)
    {
        // send otp code to the user
        $code = rand(100000, 999999);

        $user->code = $code;
        $user->otp_attempts += 1;
        $user->save();

        SmsGatewayService::sendOtp($user->phone_number, $code);
    }

    static function calculateDecayTime($attempts)
    {
        if ($attempts < 3) {
            return self::INITIAL_DECAY_SECONDS;
        }

        $increments = [self::FIRST_INCREMENT_SECONDS, self::SECOND_INCREMENT_SECONDS, self::THIRD_INCREMENT_SECONDS];
        $index = min(intdiv($attempts, 3) - 1, count($increments) - 1);

        return $increments[$index];
    }
}
