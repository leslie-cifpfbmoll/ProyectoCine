<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartelerasReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up() {
        Schema::create('carteleras_reservas', function (Blueprint $table) {
            $table->id();
            $table->integer('carteleras_id')->unsigned()->nullable();
            $table->integer('reservas_id')->unsigned()->nullable();
            $table->timestamps();
        });
        Schema::table('carteleras_reservas', function(Blueprint $table) {
            $table->foreign('carteleras_id')
                    ->references('id')->on('cartelera')
                    ->onDelete('cascade');
            $table->foreign('reservas_id')
                    ->references('id')->on('reserva')
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
        Schema::dropIfExists('carteleras_reservas');
    }
}
