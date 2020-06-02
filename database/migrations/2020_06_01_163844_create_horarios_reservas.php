<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosReservas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios_reservas', function (Blueprint $table) {
            $table->id();
            $table->integer('horarios_id')->unsigned()->nullable();
            $table->integer('reservas_id')->unsigned()->nullable();
            
            $table->timestamps();
        });
        Schema::table('horarios_reservas', function(Blueprint $table) {
            $table->foreign('horarios_id')
                    ->references('id')->on('horarios')
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
        Schema::dropIfExists('horarios_reservas');
    }
}
