<?php

namespace App\Repositories\RelatedLink;

use App\Enums\Constant;
use App\Enums\DBConstant;
use App\Models\RelatedLink;
use App\Repositories\EloquentRepository;

class RelatedLinkRepository extends EloquentRepository implements RelatedLinkRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return RelatedLink::class;
    }

    public function getListRelatedLinks()
    {
        return $this->model->get();
    }

    public function getDataForHome()
    {
        return $this->model->orderBy('created_at', 'DESC')
                           ->limit(Constant::HOME_LIMIT_RELATED_LINKS)
                           ->get();
    }
}
