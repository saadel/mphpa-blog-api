<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Post;
use App\User;

class PostsTableSeeder extends Seeder {

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
			$post = new Post;
            $post->title = $faker->paragraph(1);
            $post->content = $faker->paragraph(2);

            $user = User::find($faker->numberBetween(1,User::all()->count()));
            $post->user()->associate($user);

            $post->save();
		}
	}

}
