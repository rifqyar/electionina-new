<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dapil', function (Blueprint $table) {
            $table->increments('id_dapil');
            $table->integer('id_tps')->references('id_tps')->on('tps');
            $table->string('provinsi',50);
            $table->string('kota_kabupaten',50);
            $table->string('kecamatan',50);
            $table->string('kelurahaan',50);
            $table->string('rt',50);
            $table->string('rw',50);
            $table->string('created_by');
            $table->string('modified_by');
            $table->dateTime('create_at');
            $table->dateTime('update_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dapil');
    }
};
