<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarteleraTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'cartelera';

    /**
     * Run the migrations.
     * @table cartelera
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idCartelera');
            $table->integer('idPelicula')->unsigned()->nullable();
            $table->integer('idSala')->unsigned()->nullable();
            $table->date('horario');
            $table->integer('precio');

            $table->index(["idPelicula"], 'idPelicula_idx');
            $table->index(["idSala"], 'idSala_idx');

            $table->foreign('idPelicula', 'idPelicula_idx')->references('idPelicula')->on('peliculas')->onDelete('set null')->onUpdate('set null');
            $table->foreign('idSala', 'idSala_idx')->references('idSala')->on('sala')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
