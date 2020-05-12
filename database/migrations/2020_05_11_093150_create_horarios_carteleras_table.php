<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosCartelerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carteleras_horarios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('horarios_id')->unsigned();
            $table->integer('carteleras_id')->unsigned();
            $table->timestamps();
        });
         Schema::table('carteleras_horarios', function(Blueprint $table) {
            $table->foreign('horarios_id')
                    ->references('id')->on('horarios')
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
    public function down()
    {
        Schema::dropIfExists('horarios_carteleras');
    }
}
