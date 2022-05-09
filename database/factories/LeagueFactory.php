<?php

declare(strict_types=1);

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Enums\DBConstant;

$factory->define(App\Models\League::class, function (Faker $faker) {
    return [
        'event_id' =>  $faker->numberBetween(1, 50),
        'type' => $faker->numberBetween(DBConstant::TYPE_PRELIMINARY_ROUND, DBConstant::TYPE_FINAL_ROUND),
        'name' => Str::random(10),
        'entry_fee' => $faker->randomNumber(),
        'start_datetime' => new DateTime,
        'end_datetime' => new DateTime,
        'is_archived' => DBConstant::NOT_ARCHIVED_FLAG,
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});
