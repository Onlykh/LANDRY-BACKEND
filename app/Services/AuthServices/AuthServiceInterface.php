<?php

namespace App\Services\AuthServices;

use App\Models\User;

interface AuthServiceInterface
{
    static function createToken(User $user, string $tokenName);
    static function refreshToken(User $user, string $tokenName);
    static function revokeToken(User $user, bool $all = false): bool;
}
