<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class SalaHorariosVista extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::statement( 'CREATE VIEW horarios_disponibles AS select sala.id, horarios.id as horario_id, horarios.hora from sala, horarios order by sala.id' );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement( 'DROP VIEW horarios_disponibles' );
    }
}
