<?php

use Faker\Generator as Faker;

$factory->define(App\Gallery::class, function (Faker $faker) {
    return [
      'name' => $faker->text($maxNbChars = 15),
      'description' => $faker->text($maxNbChars = 200),
      'user_id' => (\App\User::inRandomOrder()->first())->id,
    ];
});
