<?php

declare(strict_types=1);

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Enums\DBConstant;

$factory->define(App\Models\User::class, function (Faker $faker) {
    $userType = $faker->numberBetween(DBConstant::USER_TYPE_GENERAL_USER, DBConstant::USER_TYPE_MGMT_PORTAL_USER);
    
    return [
        'user_type' => $userType,
        'login_type' => $faker->randomElement(['EMAIL', 'INSTAGRAM', 'FACEBOOK', 'TWITTER']),
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(12345678),
        'last_name_kanji' => $faker->firstName,
        'first_name_kanji' => $faker->lastName,
        'last_name_kana' => Str::random(5),
        'first_name_kana' => Str::random(5),
        'nickname' => Str::random(2),
        'sex' => $faker->numberBetween(DBConstant::SEX_NOT_KNOWN, DBConstant::SEX_FEMALE),
        'date_of_birth' => new DateTime,
        'phone' => $faker->phoneNumber,
        'city' => Str::random(4),
        'subsequent_address' => Str::random(4),
        'zip_code' => $faker->postcode,
        'is_authenticated' => $faker->numberBetween(DBConstant::IS_AUTHENTICATED_NOT_AUTHENTICATED, DBConstant::IS_AUTHENTICATED_NO_AUTHENTICATION_REQUIRED),
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});
