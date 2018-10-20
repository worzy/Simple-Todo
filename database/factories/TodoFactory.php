<?php

use Faker\Generator as Faker;

$factory->define(App\Entities\Todo::class, function (Faker $faker) {
    return [
        'name' => $faker->realText($maxNbChars = 100, $indexSize = 2),
    ];
});
