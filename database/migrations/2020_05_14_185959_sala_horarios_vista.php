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
       DB::statement( 'CREATE VIEW horarios_disponibles AS SELECT c.fecha,cs.salas_id,h.hora,ADDDATE(h.hora, INTERVAL p.duracion minute) as h_fin from cartelera c inner join carteleras_salas cs on cs.carteleras_id=c.id INNER join carteleras_horarios ch on ch.carteleras_id=c.id inner join carteleras_peliculas cp on cp.carteleras_id=c.id,horarios h,peliculas p where h.id=ch.horarios_id and p.id=cp.peliculas_id' );
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
