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
        Schema::create('calculate', function (Blueprint $table) {
            $table->integer('id_calculte');
            $table->integer('id_caleg')->references('id_caleg')->on('caleg');
            $table->integer('jumlah_suara');
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
        Schema::dropIfExists('calculate');
    }
};
