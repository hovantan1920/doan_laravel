<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
//Model
use Modules\Product\Entities\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title'       => $faker->title,
        'descride'    => $faker->name,
        'pathimage'   => $faker->name,
        'prices'      => $faker->numberBetween(0, 100000),
        'gallery_id' => $faker->numberBetween(1, 20)
    ];
});
