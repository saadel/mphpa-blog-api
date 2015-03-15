<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$tables = [
            'comments',
            'posts',
            'users'
        ];

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

		$this->call('UsersTableSeeder');
		$this->call('PostsTableSeeder');
		$this->call('CommentsTableSeeder');
	}

}
