<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreciosCartelerasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('carteleras_precios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('precios_id')->unsigned();
            $table->integer('carteleras_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('carteleras_precios', function(Blueprint $table) {
            $table->foreign('precios_id')
                    ->references('id')->on('precios')
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
        Schema::dropIfExists('carteleras_precios');
    }

}
