<?php

declare(strict_types=1);

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Enums\DBConstant;

$factory->define(App\Models\UserPoint::class, function (Faker $faker) {
    return [
        'user_id' =>  $faker->numberBetween(1, 100),
        'type' => $faker->numberBetween(DBConstant::TYPE_DEPOSIT, DBConstant::TYPE_WITHDRAWAL),
        'points_balance' => Str::random(2),
        'transacted_at' => new DateTime,
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});
