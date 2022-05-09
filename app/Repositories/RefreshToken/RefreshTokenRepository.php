<?php

declare(strict_types=1);

namespace App\Repositories\RefreshToken;

use App\Enums\DBConstant;
use App\Models\RefreshToken;
use App\Models\User;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Carbon;

class RefreshTokenRepository extends EloquentRepository implements RefreshTokenRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\RefreshToken::class;
    }

    public function getRefreshTokenEntity($encryptedRefreshToken)
    {
        $refreshTokenEntity = RefreshToken::where('encrypted_refresh_token', $encryptedRefreshToken)
//            ->where('is_blacklisted', DBConstant::NOT_BLACKLISTED)
            ->first();

        return $refreshTokenEntity;
    }

    public function checkExpiresTokenRefresh($encryptedRefreshToken)
    {
        $tokenExpires = RefreshToken::where('encrypted_refresh_token', $encryptedRefreshToken)
            ->where('expires_in', '<=', Carbon::now())
            ->first();

        return $tokenExpires;
    }

}
