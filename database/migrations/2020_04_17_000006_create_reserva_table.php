<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservaTable extends Migration {

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
    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('idUsuario')->unsigned()->nullable();
            $table->integer('idCartelera')->unsigned()->nullable();
            $table->integer('cantidad');

            $table->index(["idCartelera"], 'idCartelera_idx');
            $table->index(["idUsuario"], 'idUsuario_idx');

            $table->foreign('idCartelera', 'idCartelera_idx')
                    ->references('id')->on('cartelera')
                    ->onDelete('set null')
                    ->onUpdate('cascade');
            
            $table->foreign('idUsuario', 'idUsuario_idx')
                    ->references('id')->on('users')
                    ->onDelete('set null')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down() {
        Schema::dropIfExists($this->tableName);
    }

}
