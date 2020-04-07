<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
//Model
use Modules\Product\Entities\Gallery;

$factory->define(Gallery::class, function (Faker $faker) {
    return [
        'title'         => $faker->title,
        'descride'      => $faker->name,
        'categorie_id' => $faker->numberBetween(0, 20),
    ];
});
