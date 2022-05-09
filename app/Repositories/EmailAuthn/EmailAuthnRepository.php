<?php

namespace App\Repositories\EmailAuthn;

use App\Enums\DBConstant;
use App\Models\EmailAuthn;
use App\Repositories\EloquentRepository;

class EmailAuthnRepository extends EloquentRepository implements EmailAuthnRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return EmailAuthn::class;
    }

    public function getEmailAuthByToken($token)
    {
        return $this->model::where('token', $token)->first();
    }

    public function getByEmail($email)
    {
        return $this->model::where('email', $email)->first();
    }

    public function deleteEmailAuthByEmail($email)
    {
        return $this->model::where('email', $email)->delete();
    }
}
