<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
    return [
        'url' => $faker->imageUrl($width = 440, $height = 380),
        'gallery_id' => (\App\Gallery::inRandomOrder()->first())->id,
    ];
});
