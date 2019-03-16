<?php

use App\Models\User;
use Illuminate\Support\Str;
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

$factory->defineAs(User::class, 'usuario', function (Faker $faker) {
    return [
        'nombre' => $faker->name.' '.$faker->lastName.' '.$faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(Str::random(15)),
        'roll' => 'usuario',
        'foto' => '',
    ];
});

$factory->defineAs(User::class, 'administrador', function (Faker $faker) {
    return [
        'nombre' => $faker->name.' '.$faker->lastName.' '.$faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(Str::random(15)),
        'roll' => 'administrador',
        'foto' => '',
    ];
});

$factory->defineAs(User::class, 'vendedor', function (Faker $faker) {
    return [
        'nombre' => $faker->name.' '.$faker->lastName.' '.$faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(Str::random(15)),
        'roll' => 'vendedor',
        'foto' => '',
    ];
});
