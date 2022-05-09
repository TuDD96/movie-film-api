<?php

declare(strict_types=1);

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Enums\DBConstant;

$factory->define(App\Models\Video::class, function (Faker $faker) {
    return [
        'video_url' => Str::random(2),
        'thumbnail_url' => 'https://www.jquery-az.com/html/images/banana.jpg',
        'title' => $faker->title,
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});
