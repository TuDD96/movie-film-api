<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Constant;
use App\Repositories\RelatedLink\RelatedLinkRepositoryInterface;

class RelatedLinkService
{
    protected $relatedLinkRepository;

    public function __construct(RelatedLinkRepositoryInterface $relatedLinkRepository)
    {
        $this->relatedLinkRepository = $relatedLinkRepository;
    }

    public function getListRelatedLinks()
    {
       return $this->relatedLinkRepository->getListRelatedLinks();
    }
}
