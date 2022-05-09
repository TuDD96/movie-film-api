<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Repositories\EloquentRepositoryInterface;

interface UserRepositoryInterface extends EloquentRepositoryInterface
{
    public function getList($filters, $limit, $sorts);

    public function getEmailAuthenUser();

    public function getUserByEmail($email);

    public function getUserByTokenRefresh($userId);

    public function getUser($userId);
}
