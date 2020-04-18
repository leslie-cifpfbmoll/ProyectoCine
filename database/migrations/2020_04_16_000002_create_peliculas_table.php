<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeliculasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'peliculas';

    /**
     * Run the migrations.
     * @table peliculas
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idPelicula');
            $table->string('nombre', 45);
            $table->integer('idGenero')->unsigned()->nullable();
            $table->integer('idDirector')->unsigned()->nullable();
            $table->date('estreno');
            $table->string('duracion', 45);
            $table->string('sinopsis', 100);
            $table->string('imagen', 45);

            $table->index(["idDirector"], 'idDirector_idx');

            $table->index(["idGenero"], 'idGenero_idx');


            $table->foreign('idDirector', 'idDirector_idx')
                ->references('idDirector')->on('directores')
                ->onDelete('set null')
                ->onUpdate('set null');

            $table->foreign('idGenero', 'idGenero_idx')
                ->references('idGenero')->on('generos')
                ->onDelete('set null')
                ->onUpdate('set null');
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
