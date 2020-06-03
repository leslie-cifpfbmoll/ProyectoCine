<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas_user', function (Blueprint $table) {
            $table->id();
            $table->integer('reservas_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            
            $table->timestamps();
        });
        Schema::table('reservas_user', function(Blueprint $table) {
            $table->foreign('user_id')
                    ->references('id')->on('users')
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
        Schema::dropIfExists('reservsas _user');
    }
}
