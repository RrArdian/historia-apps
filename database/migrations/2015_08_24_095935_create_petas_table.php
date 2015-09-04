<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peta', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kategori_id');
            $table->string('nama_lokasi', 50);
            $table->string('slug_nama', 64);
            $table->text('deskripsi_singkat');
            $table->longText('deskripsi_lengkap');
            $table->string('alamat');
            $table->unsignedInteger('kecamatan_id');
            $table->double('latitude', 15, 13);
            $table->double('longitude', 14, 11);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('peta');
    }
}
