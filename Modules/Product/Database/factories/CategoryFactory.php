<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

//Model
use Modules\Product\Entities\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'title'      => $faker->title,
        'descride'   => $faker->name,
    ];
});
