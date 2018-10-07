<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Message::class, function (Faker $faker) {
    return [
        'user_id' => \App\Models\User::first()->id,
        'message_id' => $faker->name,
        'from' => $faker->phoneNumber,
        'to' => $faker->phoneNumber,
        'text' => $faker->text,
        'time' => $faker->dateTime,
    ];
});