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
            $table->id();
            $table->bigInteger('generos_id')->unsigned();
            $table->bigInteger('peliculas_id')->unsigned();
            $table->timestamps();
         
            
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
