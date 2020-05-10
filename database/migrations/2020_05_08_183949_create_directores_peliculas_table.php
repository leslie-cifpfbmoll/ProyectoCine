<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectoresPeliculasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('directores_peliculas', function (Blueprint $table) {
             $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('directores_id')->unsigned();
            $table->integer('peliculas_id')->unsigned();
            $table->timestamps();

        });
        Schema::table('directores_peliculas', function(Blueprint $table) {
            $table->foreign('directores_id')
                    ->references('id')->on('directores')
                    ->onDelete('cascade');

            $table->foreign('peliculas_id')
                    ->references('id')->on('peliculas')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('directores_peliculas');
    }

}
