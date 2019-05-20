<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Voucher::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->country,
        'description' => $faker->text,
        'image' => $faker->imageUrl,
        'expiry_date' => $faker->dateTimeBetween(Carbon::now(), '2021-00-00 00:00:00'),
        'timeout' => $faker->numberBetween(15,30),
        'facebook_link' => $faker->url,
        'popular_flag' => $faker->numberBetween(0,1),
    ];
});
