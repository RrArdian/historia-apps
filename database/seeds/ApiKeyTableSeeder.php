<?php

use Illuminate\Database\Seeder;

class ApiKeyTableSeeder extends Seeder {

	public function run () {

		DB::table('api_key')->delete();

		$data = [
			['user_id' => 1, 'client_id' => 'irwidodosquad', 'client_secret' => 'themuiezsquad', 'created_at' => new DateTime, 'updated_at' => new DateTime],
		];

		DB::table('api_key')->insert($data);
	}
}