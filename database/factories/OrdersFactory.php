<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Orders;
use Faker\Generator as Faker;

$factory->define(Orders::class, function (Faker $faker) {
    return [
        'ordertotal' => $faker->numberBetween($min = 10, $max = 200),
        'orderstatus' => $faker->randomElement($array = array ('complete','incomplete')),
        'createddatetime' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = 'AEST'),
        'customerid' => function() {
            return App\Customer::inRandomOrder()->first()->customerid;
        },
    ];
});
