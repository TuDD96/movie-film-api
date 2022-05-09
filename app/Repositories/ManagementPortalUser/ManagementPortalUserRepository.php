<?php

declare(strict_types=1);

namespace App\Repositories\ManagementPortalUser;

use App\Models\ManagementPortalUser;
use App\Repositories\EloquentRepository;

class ManagementPortalUserRepository extends EloquentRepository implements ManagementPortalUserRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return ManagementPortalUser::class;
    }

    public function getUserByEmail($email)
    {
        return $this->model::where('email', $email)->first();
    }
}
