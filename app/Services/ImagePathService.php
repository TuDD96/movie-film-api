<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ImagePath\ImagePathRepositoryInterface;

class ImagePathService
{
    protected $imagePathRepository;

    public function __construct(ImagePathRepositoryInterface $imagePathRepository)
    {
        $this->imagePathRepository = $imagePathRepository;
    }

    public function getByUserId($userId)
    {
        return $this->imagePathRepository->getByUserId($userId);
    }
}
