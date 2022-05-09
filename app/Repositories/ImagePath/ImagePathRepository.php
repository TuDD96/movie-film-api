<?php

declare(strict_types=1);

namespace App\Repositories\ImagePath;

use App\Repositories\EloquentRepository;
use App\Enums\Constant;

class ImagePathRepository extends EloquentRepository implements ImagePathRepositoryInterface
{   
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ImagePath::class;
    }

    public function checkImageExisted($object, $objectId)
    {
        switch ($object) {
            case Constant::IMAGE_OBJECT_USER:
                $column = 'user_id';

                break;

            case Constant::IMAGE_OBJECT_EVENT:
                $column = 'event_id';

                break;
        }

        $imagePath = $this->model::where($column, $objectId)->first();

        return $imagePath;
    }

    public function getByUserId($userId)
    {
        return $this->model->where('user_id', $userId)->orderBy('created_at', 'DESC')->first();
    }
}
