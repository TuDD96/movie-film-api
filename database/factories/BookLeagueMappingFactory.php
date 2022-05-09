<?php

declare(strict_types=1);

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Enums\DBConstant;

$factory->define(App\Models\BookLeagueMapping::class, function (Faker $faker) {
    static $number = 1;

    return [
        'book_id' =>  $number++,
        'league_id' => 280,
        'total_score' => $faker->numberBetween(1, 100),
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});
