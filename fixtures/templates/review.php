<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

return [

	'client_id' => $faker->numberBetween(1,10),
	'task_id' => $faker->numberBetween(1,20),
	'doer_id' => $faker->numberBetween(1,10),
	'review_content' => $faker->text($maxNbChars = 250),
	'stars' => $faker->numberBetween(1,5),
	'create_date' => $faker->dateTimeBetween('2021-12-01', 'now')->format('Y-m-d H:i:s'),
];


