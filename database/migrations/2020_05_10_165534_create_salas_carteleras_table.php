<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalasCartelerasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('carteleras_salas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('salas_id')->unsigned();
            $table->integer('carteleras_id')->unsigned();
            $table->timestamps();
        });
       Schema::table('carteleras_salas', function(Blueprint $table) {
            $table->foreign('salas_id')
                    ->references('id')->on('sala')
                    ->onDelete('cascade');

            $table->foreign('carteleras_id')
                    ->references('id')->on('cartelera')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('salas_carteleras');
    }

}
