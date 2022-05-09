<?php

namespace App\Repositories\Event;

use App\Repositories\EloquentRepositoryInterface;

interface EventRepositoryInterface extends EloquentRepositoryInterface
{
    public function search();

    public function getList($keyword, $page, $limit);

    public function getDetail($eventId);
}
