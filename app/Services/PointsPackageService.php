<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\PointsPackage\PointsPackageRepositoryInterface;

class PointsPackageService
{
    protected $pointsPackageRepository;

    public function __construct(PointsPackageRepositoryInterface $pointsPackageRepository)
    {
        $this->pointsPackageRepository = $pointsPackageRepository;
    }

    public function getPointsPackageList()
    {
        return $this->pointsPackageRepository->getPointsPackageList();
    }
}
