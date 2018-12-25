<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
      'content' => $faker->text($maxNbChars = 100),
      'gallery_id' => (\App\Gallery::inRandomOrder()->first())->id,
      'user_id' => (\App\User::inRandomOrder()->first())->id,
    ];
});
