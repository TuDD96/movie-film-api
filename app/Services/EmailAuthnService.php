<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\EmailAuthn\EmailAuthnRepositoryInterface;
use Carbon\Carbon;

class EmailAuthnService extends BaseService
{
    protected $emailAuthnRepository;

    public function __construct(EmailAuthnRepositoryInterface $emailAuthnRepository)
    {
        $this->emailAuthnRepository = $emailAuthnRepository;
    }

    public function getEmailAuthByToken($token)
    {
        return $this->emailAuthnRepository->getEmailAuthByToken($token);
    }

    public function isResetTokenExpire($timeCheck, $configTokenExpire)
    {
        $configTokenExpire = $configTokenExpire * 60;
        $isExpire = Carbon::parse($timeCheck)->addSeconds($configTokenExpire)->isPast();

        return $isExpire;
    }

    public function deleteEmailAuthn($id)
    {
        return $this->emailAuthnRepository->delete($id);
    }
}
