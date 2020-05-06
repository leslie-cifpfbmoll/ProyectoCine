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
            $table->increments('id');
            $table->integer('idPelicula')->unsigned()->nullable();
            $table->integer('idSala')->unsigned()->nullable();
            $table->date('horario');
            $table->integer('precio');
            $table->timestamps();
            

            $table->index(["idPelicula"], 'idPelicula_idx');
            $table->index(["idSala"], 'idSala_idx');

            $table->foreign('idPelicula', 'idPelicula_idx')->references('id')->on('peliculas')
                    ->onDelete('set null')
                    ->onUpdate('cascade');
            
            $table->foreign('idSala', 'idSala_idx')->references('id')->on('sala')
                    ->onDelete('set null')
                    ->onUpdate('cascade');
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
