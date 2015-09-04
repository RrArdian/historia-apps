<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

	public function run () {

		DB::table('users')->delete();

		$data = [
			['id' => 1, 'name' => 'admin', 'email' => 'admin@skripsi.com', 'password' => bcrypt('admin'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
		];

		DB::table('users')->insert($data);
	}
}