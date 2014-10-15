<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class BusinessInvoicesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Models\Invoice::create([
				'issuer_id' => $faker->numberBetween(2,5),
				'receiver_id' => $faker->numberBetween(2,5),
				'pac_id' => 1,
				'uuid' => $faker->uuid,
				'issuing_datetime' => $faker->iso8601('now'),
				'certitication_datetime' => $faker->iso8601('now'),
				'ammount' => $faker->randomFloat(2, 100, 9999),
				'effect' => $faker->randomElement(array(1, -1)),
				'cancelation_datetime' => $faker->optional()->iso8601('now'),
			]);
		}
	}

}