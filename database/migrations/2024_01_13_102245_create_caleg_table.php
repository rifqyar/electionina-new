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
        Schema::create('caleg', function (Blueprint $table) {
            $table->integer('id_caleg');
            $table->integer('id_partai')->references('id_partai')->on('partai');
            $table->integer('id_dapil')->references('dapil')->on('dapil');
            $table->string('name_caleg');
            $table->string('nomor_urut');
            $table->text('alamat');
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
        Schema::dropIfExists('caleg');
    }
};
