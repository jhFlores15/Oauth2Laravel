<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Encuestas_Carozzi\Rol;
use Faker\Generator as Faker;

$factory->define(Rol::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
    ];
});
