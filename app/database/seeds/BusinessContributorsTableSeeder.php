<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class BusinessContributorsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 5) as $index)
		{
			Models\Contributor::create([
				'user_id' => 1,
				'rfc' => $faker->lexify($string = '????').$faker->time($format = 'Ymd', $max = 'now').$faker->randomElement(['H', 'M']).$faker->lexify($string = '??'),
				'name' => $faker->word,
				'password' => Crypt::encrypt($faker->word),
				'status' => 1
			]);
		}
	}

}