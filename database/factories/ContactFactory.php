<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Contact::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'member' => 0,
        'status' => 0
    ];
});