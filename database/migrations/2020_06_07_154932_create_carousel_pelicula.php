<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarouselPelicula extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('carrousel_peliculas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('carrousel_id')->unsigned();
            $table->integer('peliculas_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('carrousel_peliculas', function(Blueprint $table) {
            $table->foreign('peliculas_id')
                    ->references('id')->on('peliculas')
                    ->onDelete('cascade');
            $table->foreign('carrousel_id')
                    ->references('id')->on('carrousel')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('carrousel_pelicula');
    }

}
