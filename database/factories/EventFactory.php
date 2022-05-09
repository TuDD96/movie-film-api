<?php

declare(strict_types=1);

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Enums\DBConstant;

$factory->define(App\Models\Event::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'body' => Str::random(80),
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});
