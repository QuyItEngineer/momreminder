<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Call::class, function (Faker $faker) {
    return [
        'user_id' => \App\Models\User::first()->id,
        'call_id' => $faker->name,
        'from_phone' => $faker->phoneNumber,
        'to_phone' => $faker->phoneNumber,
        'sentense' => 'Reminder',
        'state' => 'active',
        'time' => $faker->dateTime,
        'status' => 0,
    ];
});