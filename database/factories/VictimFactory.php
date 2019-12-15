<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Victim;
use Faker\Generator as Faker;

$factory->define(Victim::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'lastname'=>$faker->lastName,
        'email'=>$faker->email,
        'identity_number'=>$faker->numberBetween(12345678,12345678),
        'identification_type_id'=>$faker->numberBetween(1,2),
        'country_of_birth_id'=>1,
        'city_of_residence_id'=>1,
        'address'=>$faker->address,
        'telephone'=>$faker->phoneNumber
    ];
});
