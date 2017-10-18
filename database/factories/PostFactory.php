<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Post::class, function (Faker $faker) {

    return [
        'poster_id' => 1,
        'title' => $faker->sentence(rand(6,12)),
        'body' => $faker->text(rand(200,400)),
        'published' => true,
    ];
});
