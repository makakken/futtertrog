<?php

use App\Meal;
use Faker\Generator as Faker;

$factory->define(App\Meal::class, function (Faker $faker) {
    $date = $faker->dateTimeThisMonth->format('Y-m-d');

    return [
        'price' => $faker->randomFloat(2, 0, 10),
        'title' => $faker->sentence,
        'description' => $faker->sentences(1, true),
        'date_from' => $date,
        'date_to' => $date,
        'provider' => Meal::$providers[array_rand(Meal::$providers)],
    ];
});
