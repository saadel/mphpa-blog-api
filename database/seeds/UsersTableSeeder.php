<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\User;

class UsersTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();

		foreach (range(1, 20) as $index)
		{
			$user = new User;
            $user->name = $faker->name;
            $user->email = $faker->email;
            $user->password = Hash::make($faker->word);
            $user->save();
		}
	}

}
