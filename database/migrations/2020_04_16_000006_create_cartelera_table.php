<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarteleraTable extends Migration {

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
    public function up() {
       Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('fecha');
            $table->timestamps();
        
        });
         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists($this->tableName);
    }

}
