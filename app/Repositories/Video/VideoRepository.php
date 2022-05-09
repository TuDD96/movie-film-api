<?php

namespace App\Repositories\Video;

use App\Enums\Constant;
use App\Enums\DBConstant;
use App\Models\Video;
use App\Repositories\EloquentRepository;

class VideoRepository extends EloquentRepository implements VideoRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Video::class;
    }

    public function search($filters)
    {
        return $this->model::where('title', 'like', '%' . $filters['title']['value'] . '%')
            ->orderBy('created_at', Constant::ORDER_BY_DESC)
            ->get();
    }

    public function getDataForHome()
    {
        return $this->model->orderBy('created_at', 'DESC')
                           ->limit(Constant::HOME_LIMIT_VIDEOS)
                           ->get();
    }

    public function getVideoList($limit, $page)
    {
        return $this->model->select('videos.*')
                           ->orderBy('videos.created_at', 'DESC')
                           ->limit($limit)->offset(($page - 1) * $limit)
                           ->get();
    }

    public function getSearchData($keyword)
    {
        return $this->model->where('title', 'like', '%' . $keyword . '%')->get();
    }
}
