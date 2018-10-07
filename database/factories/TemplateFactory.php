<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Template::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'message' => $faker->sentence,
        'send_type' => $faker->numberBetween(0,1),
        'bot' => $faker->numberBetween(0,1)
    ];
});
