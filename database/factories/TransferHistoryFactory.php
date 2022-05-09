<?php

declare(strict_types=1);

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Enums\DBConstant;

$factory->define(App\Models\TransferHistory::class, function (Faker $faker) {
    return [
        'user_point_id' =>  $faker->numberBetween(1, 50),
        'status' => $faker->numberBetween(DBConstant::STATUS_APPLIED, DBConstant::STATUS_APPLIED_APPROVED),
        'withdrawal_amount' => $faker->randomNumber(),
        'transfer_fee' => $faker->randomNumber(),
        'transfer_amount' => $faker->randomNumber(),
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});
