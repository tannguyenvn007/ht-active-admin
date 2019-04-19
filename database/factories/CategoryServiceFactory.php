<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\CategoryService;
use Faker\Generator as Faker;

$factory->define(CategoryService::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text($maxNbChars = 200),
        'icon' => $faker->imageUrl($width = 640, $height = 480),
    ];
});
