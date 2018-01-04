<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Aula::class, function (Faker\Generator $faker) {
    return [
        'numero_aula' => $faker->unique->numerify('###'),
        'descripcion' => $faker->sentence($nbWords = 6, $variableNbWords = true), 
    ];
});

$factory->define(App\Curso::class, function (Faker\Generator $faker) {
    return [
        'nombre' => $faker->name,
        'duracion' => $faker->numberBetween($min=10, $max=50),
        'maX_alumnos' => $faker->numberBetween($min=7, $max=20),
    ];
});

$factory->define(App\Alumno::class, function (Faker\Generator $faker) {
    return [
        'dni' => $faker->unique()->numerify('########'),
        'nombres' => $faker->firstName,
        'apellidos' => $faker->lastName,
        'sexo' => $faker-> randomElement($array = array ('F','M')),
        'direccion' => $faker->streetAddress,
        'telefono' => $faker->tollFreePhoneNumber,
        'email' => $faker->unique()->safeEmail,        

    ];
});