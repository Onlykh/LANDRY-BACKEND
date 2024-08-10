<?php

namespace App\Http\Controllers;

use App\Exceptions\RateLimitException;
use App\Http\Resources\UserResources\UserResource;
use App\Services\AuthServices\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(private AuthService $authService) {}

    public function verifyUser(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'phone_number' => 'required|numeric|digits:8'
        ]);

        $user = $this->authService->findUserOrCreateAndSendOtp($request->only('phone_number', 'identifier'));

        return response()->json([
            'phone_number' => $user->phone_number,
            'code' => $user->code
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|numeric|digits:8',
            'otp' => 'required|numeric|digits:6'
        ]);

        $user = $this->authService->verifyOtp($request->phone_number, $request->otp);

        $token = $this->authService->createToken($user, 'auth_token');
        $userResource = new UserResource($user);

        return response()->json(
            $userResource->toArray($request)
                + [
                    'token' => $token->plainTextToken
                ]
        );
    }


    public function logout(Request $request) {}
}
