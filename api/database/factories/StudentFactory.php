<?php

use Faker\Generator as Faker;

$factory->define(\App\Student::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'ra' =>  $faker->unique()->randomNumber,
        'cpf' =>  rand(100,999) . "." . rand(100,999) . "." . rand(100,999) . "-" . rand(0,99)
    ];
});
