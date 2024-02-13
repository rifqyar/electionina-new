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
        Schema::create('total_suara', function (Blueprint $table) {
            $table->integer('id_total_suara');
            $table->string('totla_suara_terpilih');
            $table->string('suara_partai');
            $table->string('golput');
            $table->string('suart_suara_rusak');
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
        Schema::dropIfExists('total_suara');
    }
};
