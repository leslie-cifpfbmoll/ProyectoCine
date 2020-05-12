<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeliculasCartelerasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('carteleras_peliculas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('peliculas_id')->unsigned();
            $table->integer('carteleras_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('carteleras_peliculas', function(Blueprint $table) {

            $table->foreign('peliculas_id')
                    ->references('id')->on('peliculas')
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
        Schema::dropIfExists('peliculas_carteleras');
    }

}
