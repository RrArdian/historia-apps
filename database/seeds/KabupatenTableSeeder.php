<?php

use Illuminate\Database\Seeder;

class KabupatenTableSeeder extends Seeder {

	public function run () {

		DB::table('kabupaten')->delete();

		$data = [
			['id' => 1, 'nama_kabupaten' => 'Bantul', 'slug_nama' => str_slug('Bantul'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['id' => 2, 'nama_kabupaten' => 'Gunung Kidul', 'slug_nama' => str_slug('Gunung Kidul'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['id' => 3, 'nama_kabupaten' => 'Kulon Progo', 'slug_nama' => str_slug('Kulon Progo'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['id' => 4, 'nama_kabupaten' => 'Sleman', 'slug_nama' => str_slug('Sleman'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['id' => 5, 'nama_kabupaten' => 'Yogyakarta', 'slug_nama' => str_slug('Yogyakarta'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
		];

		DB::table('kabupaten')->insert($data);
	}
}