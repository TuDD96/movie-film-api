<?php

namespace App\Repositories\Event;

use App\Enums\Constant;
use App\Models\Event;
use App\Repositories\EloquentRepository;

class EventRepository extends EloquentRepository implements EventRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Event::class;
    }

    public function search()
    {
        return $this->model::orderBy('created_at', Constant::ORDER_BY_DESC)->get();
    }

    public function getList($keyword, $page, $limit)
    {
        $query = $this->model->select(
            'events.*',
            'ip.image_url')
            ->leftJoin('image_paths as ip', 'ip.event_id', 'events.event_id');
        
        if ($keyword) {
            $query = $query->where('events.title', 'like', '%' . $keyword . '%')
                           ->orWhere('events.body', 'like', '%' . $keyword . '%');
        }

        $data = $query->orderBy('events.created_at', 'DESC')
                      ->paginate($limit);

        return $data;
    }

    public function getDetail($eventId)
    {
        return $this->model->select(
            'events.*',
            'ip.image_url')
            ->leftJoin('image_paths as ip', 'ip.event_id', 'events.event_id')
            ->where('events.event_id', $eventId)
            ->first();
    }
}
