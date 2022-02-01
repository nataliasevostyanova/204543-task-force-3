<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

return [
    'task_id' => $faker->numberBetween(1,9),
	'doer_id' => $faker->numberBetween(1,10),
    'execute_budget' => $faker->numberBetween(300,10000),
	'comment' => $faker->text($maxNbChars = 250),

	'created_at' => $faker->dateTimeBetween('2019-01-01', 'now')->format('Y-m-d H:i:s'),
];


