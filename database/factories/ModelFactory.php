<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'role' => $faker->randomElement(['usuario', 'instructor', 'admin', 'superadmin'])
    ];
});


$factory->define(App\Detalles::class, function (Faker\Generator $faker) {
    return [
        'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'accept' => $faker->boolean,
        'tel' => $faker->phoneNumber,
        'rating' => $faker->randomElement(['1', '3', '5', '7', '9']),
        'user_id' => $faker->randomElement(['1', '3', '5', '7', '9'])
    ];
});

$factory->define(App\Clases::class, function (Faker\Generator $faker) {
    return [
      'nombre'=>$faker->name,
      'tipo'=>$faker->name,
      'descripcion'=>$faker->name,
      'imagen' =>$faker->name,
      'precio' =>$faker->name
    ];
});

$factory->define(App\Slide::class, function (Faker\Generator $faker) {
    return [
      'description'=>$faker->name,
      'image'=>$faker->name,
      'order'=>$faker->name
    ];
});
