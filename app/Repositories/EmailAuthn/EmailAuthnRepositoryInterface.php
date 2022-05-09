<?php

namespace App\Repositories\EmailAuthn;

use App\Repositories\EloquentRepositoryInterface;

interface EmailAuthnRepositoryInterface extends EloquentRepositoryInterface
{
    public function getByEmail($email);

    public function getEmailAuthByToken($token);
}
