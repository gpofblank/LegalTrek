<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Matter;
use Faker\Generator as Faker;

$factory->define(Matter::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->paragraph,
    ];
});
