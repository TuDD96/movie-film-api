<?php

namespace App\Repositories\Video;

use App\Repositories\EloquentRepositoryInterface;

interface VideoRepositoryInterface extends EloquentRepositoryInterface
{
    public function search($filters);

    public function getDataForHome();

    public function getVideoList($limit, $page);

    public function getSearchData($keyword);
}
