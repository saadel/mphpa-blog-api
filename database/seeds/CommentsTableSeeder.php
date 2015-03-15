<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Comment;
use App\Post;
use App\User;

class CommentsTableSeeder extends Seeder {

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
			$comment = new Comment;
            $comment->content = $faker->paragraph(1);

            $user = User::find($faker->numberBetween(1,User::all()->count()));
            $post = Post::find($faker->numberBetween(1,Post::all()->count()));

            $comment->user()->associate($user);
            $comment->post()->associate($post);

            $comment->save();
		}
	}

}
