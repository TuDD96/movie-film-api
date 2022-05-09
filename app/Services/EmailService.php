<?php

declare(strict_types=1);

namespace App\Services;

use App\Mail\Portal\ForgotPasswordMail;
use App\Mail\App\SendMailConfirmRegister;
use Mail;

class EmailService extends BaseService
{
    public function sendMailResetPassword($email, $resetToken, $portal = false)
    {
        $subDirectory = strlen(config('app.sub_directory')) > 0 ? config('app.sub_directory') . "/" : "";
        if ($portal) {
            $url = url($subDirectory . sprintf(config('auth.password_reset_url'), $resetToken));
        } else {
            $url = url($subDirectory . sprintf(config('auth.password_reset_confirm_url'). $resetToken));
        }

        $tokenExpireTime = config('auth.passwords.portals.expire');

        return Mail::to($email)->queue(new ForgotPasswordMail($url, $tokenExpireTime));
    }

    public function sendMailRegisterConfirm($email, $resetToken)
    {
        $url = url(sprintf(config('auth.register_confirm_url') . $resetToken));
        $tokenExpireTime = config('auth.email_auth_timeout');

        return Mail::to($email)->queue(new SendMailConfirmRegister($url, $tokenExpireTime));
    }
}
