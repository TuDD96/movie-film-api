<?php

declare(strict_types=1);

namespace App\Repositories\ManagementPortalUser;

use App\Repositories\EloquentRepositoryInterface;

interface ManagementPortalUserRepositoryInterface extends EloquentRepositoryInterface
{
    public function getUserByEmail($email);
}
