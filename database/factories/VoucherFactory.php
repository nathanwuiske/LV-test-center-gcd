<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Voucher::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'description' => $faker->text,
        'photo' => $faker->imageUrl,
        'expiry_date' => $faker->dateTimeBetween(Carbon::now(), '2021-00-00 00:00:00'),
        'tags_id' => $faker->numberBetween(1,10),
        'category' => $faker->firstName,
        'facebook_link' => $faker->url,
        'popular_flag' => $faker->numberBetween(0,1),
    ];
});
