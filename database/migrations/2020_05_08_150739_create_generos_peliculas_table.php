<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenerosPeliculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generos_peliculas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('generos_id')->unsigned();
            $table->integer('peliculas_id')->unsigned();
            $table->timestamps();
         
        });
        Schema::table('generos_peliculas', function(Blueprint $table) {
            $table->foreign('generos_id')
                    ->references('id')->on('generos')
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
    public function down()
    {
        Schema::dropIfExists('generos_peliculas');
    }
}
