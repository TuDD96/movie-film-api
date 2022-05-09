<?php

declare(strict_types=1);

namespace App\Repositories\RefreshToken;

use App\Repositories\EloquentRepositoryInterface;

interface RefreshTokenRepositoryInterface extends EloquentRepositoryInterface
{
    public function getRefreshTokenEntity($encryptedRefreshToken);

    public function checkExpiresTokenRefresh($encryptedRefreshToken);

}
