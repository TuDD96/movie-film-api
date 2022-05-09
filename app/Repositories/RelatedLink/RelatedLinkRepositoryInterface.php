<?php

namespace App\Repositories\RelatedLink;

use App\Repositories\EloquentRepositoryInterface;

interface RelatedLinkRepositoryInterface extends EloquentRepositoryInterface
{
    public function getDataForHome();

    public function getListRelatedLinks();
}
