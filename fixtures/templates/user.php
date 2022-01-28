<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

return [

    'full_name' => $faker->name,
    'sign_date' => $faker->dateTimeBetween('2021-01-01', '2021-11-01')->format('Y-m-d'),
    'role' => $faker->numberBetween(0, 1),
    'phone' => $faker->unique()->e164phoneNumber(1, 11),
    'email' => $faker->unique()->email,
    'telegram' => $faker->unique()->word,
    'password' => $faker->unique()->password,
    'avatar' => $faker->imageUrl,     
    'about_user' => $faker->realTextBetween($minNbChars = 160, $maxNbChars = 200, $indexSize = 2),
    'birthdate' => $faker->dateTimeBetween('1980-01-01', '2004-01-01')->format('Y-m-d'),
    'town_id' => $faker->numberBetween(1, 1000),

];
