<?php

use Illuminate\Database\Seeder;

class KategoriTableSeeder extends Seeder {

	public function run () {

		DB::table('kategori')->delete();

		$data = [
			['id' => 1, 'nama_kategori' => 'Prasejarah', 'slug_nama' => str_slug('Prasejarah'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['id' => 2, 'nama_kategori' => 'Hindu Budha', 'slug_nama' => str_slug('Hindu Budha'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['id' => 3, 'nama_kategori' => 'Islam', 'slug_nama' => str_slug('Islam'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['id' => 4, 'nama_kategori' => 'Kolonial', 'slug_nama' => str_slug('Kolonial'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
		];

		DB::table('kategori')->insert($data);
	}
}