<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\RefreshToken\RefreshTokenRepository;
use Cookie;

class RefreshTokenService extends BaseService
{
    protected $refreshTokenRepository;

    public function __construct(
        RefreshTokenRepository $refreshTokenRepository
    )
    {
        $this->refreshTokenRepository = $refreshTokenRepository;
    }

    public function getRefreshTokenEntity($encryptedRefreshToken)
    {
        return $this->refreshTokenRepository->getRefreshTokenEntity($encryptedRefreshToken);
    }

    public function checkTokenExpires($encryptedRefreshToken)
    {
        return $this->refreshTokenRepository->checkExpiresTokenRefresh($encryptedRefreshToken);
    }
}
