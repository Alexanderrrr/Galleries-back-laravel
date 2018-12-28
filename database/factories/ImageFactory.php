<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
    return [
        'url' => $faker->imageUrl($width = 200, $height = 150),
        'gallery_id' => (\App\Gallery::inRandomOrder()->first())->id,
    ];
});
