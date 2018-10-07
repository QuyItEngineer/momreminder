<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Package::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->numberBetween(0, 100),
        'credit' => $faker->numberBetween(0, 100),
        'description' => $faker->text(),
        'sort_order' => $faker->randomDigit,
        'status' => 0
    ];
});