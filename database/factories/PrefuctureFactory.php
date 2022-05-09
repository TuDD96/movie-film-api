<?php

declare(strict_types=1);

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Models\Prefecture::class, function (Faker $faker) {
    return [
        'name' => Str::random(5),
        'display_order' => $faker->numberBetween(1,2),
        'is_default' => $faker->numberBetween(1,2),
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});
