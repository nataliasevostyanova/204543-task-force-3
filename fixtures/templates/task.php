<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

$faker = Faker\Factory::create('ru_RU');
return [
	'created_date' => $faker->dateTimeBetween('2021-11-01', 'now')->format('Y-m-d H:i:s'),
    'client_id' => $faker->numberBetween(1,15),
    'doer_id' => $faker->numberBetween(1,15),
    'town_id' => $faker->numberBetween(1, 1000),
    'title' => $faker->sentence($nbWords = 2, $variableNbWords = true),
    'description' => $faker->realTextBetween($minNbChars = 160, $maxNbChars = 200, $indexSize = 2),
    'category_id' => $faker->numberBetween(1,8),
    'budget' => $faker->numberBetween(300,10000),
    'finish_date' =>$faker->dateTimeBetween('2022-02-15', '2022-05-31')->format('Y-m-d'),
    'task_status'=> $faker->randomElement($array = ['new','undo','working', 'failed', 'finished']),

];