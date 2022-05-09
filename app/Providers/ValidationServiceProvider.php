<?php

declare(strict_types=1);

namespace App\Providers;

use App\Enums\Constant;
use App\Enums\DBConstant;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\User;

class ValidationServiceProvider extends ServiceProvider
{
    public function register()
    {
       
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('check_sex', function ($attribute, $value, $parameters, $validator) {
            if (!in_array($value, Constant::SEX_RANGE)) {
                return false;
            }

            return true;
        });

        Validator::extend('validate_time', function ($attribute, $value, $parameters, $validator) {
            $datetime = explode(" ", $value);
            $date = $datetime[0];
            $time = $datetime[1];
            $now = Carbon::now();
            
            $exDate = explode("-", $date);
            $exTime = explode(":", $time);

            if ((int) $exDate[0] < $now->year) return false;
            if ((int) $exDate[0] == $now->year && 
                (int) $exDate[1] < $now->month
            ) return false;
            if ((int) $exDate[0] == $now->year && 
                (int) $exDate[1] == $now->month && 
                (int) $exDate[2] < $now->day
            ) return false;
            if ((int) $exDate[0] == $now->year && 
                (int) $exDate[1] == $now->month && 
                (int) $exDate[2] == $now->day &&
                (int) $exTime[0] < $now->hour
            ) return false;
            if ((int) $exDate[0] == $now->year && 
                (int) $exDate[1] == $now->month && 
                (int) $exDate[2] == $now->day &&
                (int) $exTime[0] == $now->hour &&
                (int) $exTime[1] < $now->minute
            ) return false;

            return true;
        });

        Validator::extend('check_email_valid', function ($attribute, $value, $parameters, $validator) {
            $user = User::where('email', $value)
                          ->where('is_authenticated', DBConstant::IS_AUTHENTICATED_AUTHENTICATED)
                          ->where('is_archived', DBConstant::IS_NOT_ARCHIVED)
                          ->first();

            if (!$user) {
                return false;
            }

            return true;
        });
    }
}
