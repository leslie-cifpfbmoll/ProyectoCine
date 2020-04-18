<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'reserva';

    /**
     * Run the migrations.
     * @table reserva
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idReserva');
            $table->integer('idUsuario')->unsigned()->nullable();
            $table->integer('idCartelera')->unsigned()->nullable();
            $table->integer('cantidad');

            $table->index(["idCartelera"], 'idCartelera_idx');


            $table->foreign('idCartelera', 'idCartelera_idx')
                ->references('idCartelera')->on('cartelera')
                ->onDelete('set null')
                ->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
