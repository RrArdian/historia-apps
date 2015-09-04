<?php

use App\Http\Models\Peta;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PetaTableSeeder extends Seeder {

	public function run () {

		DB::table('peta')->delete();

		$faker = Faker::create();

		for($i = 0; $i < 30; $i++){
			Peta::create([
			    'kategori_id' => rand(1, 4),
			    'nama_lokasi' => $faker->sentence($nbWords = 4),
			    'slug_nama' => str_slug($faker->sentence($nbWords = 4)),
			    'deskripsi_singkat' => $faker->text($maxNbChars = 250),
			    'deskripsi_lengkap' => $faker->text($maxNbChars = 400),
			    'alamat' => $faker->address,
			    'kecamatan_id' => rand(1, 78),
			    'latitude' => $faker->latitude,
			    'longitude' => $faker->longitude
			]);
		}
	}
}