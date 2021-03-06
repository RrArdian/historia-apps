<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //$this->call(UserTableSeeder::class);
        //$this->call(KabupatenTableSeeder::class);
        //$this->call(KecamatanTableSeeder::class);
        //$this->call(KategoriTableSeeder::class);
        //$this->call(PetaTableSeeder::class);
        //$this->call(CagarBudayaTableSeeder::class);
        $this->call(ApiKeyTableSeeder::class);

        Model::reguard();
    }
}
