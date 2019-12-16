<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'victim_id'=>$faker->numberBetween(1,2),
        'appointed_at'=>$faker->dateTimeBetween('now','5 days')
    ];
});
