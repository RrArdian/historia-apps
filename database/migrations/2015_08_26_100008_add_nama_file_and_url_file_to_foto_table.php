<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNamaFileAndUrlFileToFotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('foto', function (Blueprint $table) {
            $table->string('nama_file')->after('keterangan_foto');
            $table->string('url_foto')->after('nama_file');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('foto', function (Blueprint $table) {
            $table->dropColumn('nama_file');
            $table->dropColumn('url_foto');
        });
    }
}
