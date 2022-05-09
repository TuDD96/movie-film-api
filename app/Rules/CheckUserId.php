<?php

declare(strict_types=1);

namespace App\Rules;

use App\Repositories\User\UserRepository;
use Illuminate\Contracts\Validation\Rule;

class CheckUserId implements Rule
{
    /**
     * Create a new rule instance.
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (auth()->user()->user_type == 1) return false;
        if(!empty($value)) {
            $userRepository = new UserRepository();
            $listUserIds = $userRepository->getAllUserId();
            $userIds = array_unique(explode(',', $value));

            return (preg_match('/^[0-9,]+$/', $value));
            //  && !array_diff($userIds, $listUserIds));
        }
        
        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if (auth()->user()->user_type == 1) return "システム管理者はPush通知を作成できないです。";
        
        return 'ユーザーが存在しません。';
    }
}
