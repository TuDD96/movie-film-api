<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Prefecture\PrefectureRepositoryInterface;

class PrefectureService
{
    protected $prefectureRepository;

    public function __construct(PrefectureRepositoryInterface $prefectureRepository)
    {
        $this->prefectureRepository = $prefectureRepository;
    }

    public function getPrefectureList()
    {
        return $this->prefectureRepository->getList();
    }
}
