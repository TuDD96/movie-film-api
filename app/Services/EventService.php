<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Constant;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\League\LeagueRepositoryInterface;
use App\Repositories\Book\BookRepositoryInterface;
use App\Services\ImageService;
use App\Traits\CollectionPagination;
use Exception;
use Illuminate\Support\Facades\DB;

class EventService extends BaseService
{
    protected $eventRepository;
    protected $leagueRepository;
    protected $bookRepository;
    protected $imageService;

    public function __construct(
        EventRepositoryInterface $eventRepository,
        LeagueRepositoryInterface $leagueRepository,
        BookRepositoryInterface $bookRepository,
        ImageService $imageService
    ) {
        $this->eventRepository = $eventRepository;
        $this->leagueRepository = $leagueRepository;
        $this->bookRepository = $bookRepository;
        $this->imageService = $imageService;
    }

    public function searchPagination($request)
    {
        $limit = $request['limit'] ?? Constant::DEFAULT_LIMIT;
        $sorts = $request['sort'] ?? '';

        $data = $this->eventRepository->search();

        if (!empty($sorts)) {
            $sorts = explode(',', $sorts);
            if (is_array($sorts)) {
                foreach($sorts as $sort) {
                    if ($sort) {
                        $sort = explode('-', $sort);
                        $sortField = $sort[0];
                        $sortBy = strtolower($sort[1]);
                        if ($sortBy === Constant::ORDER_BY_ASC) {
                            $data = $data->sortBy($sortField, SORT_NATURAL|SORT_FLAG_CASE);
                        } else {
                            $data = $data->sortByDesc($sortField, SORT_NATURAL|SORT_FLAG_CASE);
                        }
                    }
                }
            }
        }
        $events = (new CollectionPagination($data))->paginate($limit);
        foreach ($events as $event) {
            $event->image_path = $this->imageService->getS3Url(Constant::IMAGE_OBJECT_EVENT, $event->event_id);
        }

        return $events;
    }

    public function delete($request)
    {
        DB::beginTransaction();
        try {
            $eventId = $request->event_id;
            if (!$eventId) {
                return [
                    'success' => false,
                    'msg' => trans('errors.MSG_5006')
                ];
            }
            $this->eventRepository->delete($eventId);
            $this->leagueRepository->deleteLeagueByEventId($eventId);
            DB::commit();

            return [
                'success' => true,
                'msg' => trans('message.delete_success')
            ];
        } catch (Exception $exception) {
            DB::rollBack();

            return [
                'success' => false,
                'msg' => trans('errors.MSG_5006')
            ];
        }
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only(['title', 'body', 'event_image']);
            $id = $request->event_id;
            $this->eventRepository->update($id, $data);
            if (array_key_exists('event_image', $data)) {
                $this->imageService->uploadImageToS3($data['event_image'], Constant::IMAGE_OBJECT_EVENT, $id);
            }
            DB::commit();

            return [
                'success' => true,
                'msg' => trans('message.update_success')
            ];
        } catch (Exception $exception) {
            DB::rollBack();

            return [
                'success' => false,
                'msg' => trans('errors.MSG_5004')
            ];
        }
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only([
                'title',
                'body',
                'event_image_add'
            ]);
            $event = $this->eventRepository->create($data);
            if (array_key_exists('event_image_add', $data)) {
                $this->imageService->uploadImageToS3($data['event_image_add'], Constant::IMAGE_OBJECT_EVENT, $event->event_id);
            }
            DB::commit();

            return [
                'success' => true,
                'msg' => trans('message.add_success')
            ];
        } catch (Exception $exception) {
            DB::rollBack();

            return [
                'success' => false,
                'msg' => trans('errors.MSG_5003')
            ];
        }
    }

    public function getEventList($params)
    {
        $page = $params['page'] ?? Constant::DEFAULT_PAGE;
        $limit = $params['perpage'] ?? Constant::EVENT_LIMIT;
        $keyword = $params['keyword'] ?? '';
        $events = $this->eventRepository->getList($keyword, $page, $limit);

        $data = [
            'page' => $page,
            'total_page' => $events->lastPage(),
            'events' => $events->items()
        ];

        return $data;
    }

    public function getEventDetail($eventId, $userId)
    {
        try {
            $event = $this->eventRepository->getDetail($eventId);
            $books = $this->bookRepository->getByUserId($userId);
            $leagues = $this->leagueRepository->getByEvent($eventId, $userId, $books);
            $leagues = $leagues->map(function($item) {
                if (!$item->applicant_id) {
                    $item['is_purchased'] = 0;
                } else {
                    $item['is_purchased'] = 1;
                }

                return $item;
            });
            $event->leagues = $leagues;

            return $event;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
