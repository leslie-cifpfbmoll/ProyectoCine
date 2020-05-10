<<<<<<< OURS
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeliculasTable extends Migration {

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
    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre', 45);
            //$table->integer('idGenero')->unsigned()->nullable();
            //$table->integer('idDirector')->unsigned()->nullable();
            $table->date('estreno');
            $table->string('duracion', 45);
            $table->string('sinopsis', 1500);
            $table->string('filename')->nullable();
            $table->string('mime')->nullable();
            $table->string('original_filename')->nullable();
            $table->timestamps();

            // $table->index(["idDirector"], 'idDirector_idx');
            // $table->index(["idGenero"], 'idGenero_idx');
            //$table->foreign('idDirector', 'idDirector_idx')
            // ->references('id')->on('directores')
            // ->onDelete('set null')
            // ->onUpdate('cascade');
            //  $table->foreign('idGenero', 'idGenero_idx')
            //     ->references('id')->on('generos')
            //    ->onDelete('set null')
            //  ->onUpdate('cascade');
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
=======
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeliculasTable extends Migration {

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
    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre', 45);
            //$table->integer('idGenero')->unsigned()->nullable();
            //$table->integer('idDirector')->unsigned()->nullable();
            $table->date('estreno');
            $table->string('duracion', 45);
            $table->string('sinopsis', 1500);
            $table->string('imagen', 45);
            $table->timestamps();
            
           // $table->index(["idDirector"], 'idDirector_idx');

           // $table->index(["idGenero"], 'idGenero_idx');


            //$table->foreign('idDirector', 'idDirector_idx')
                   // ->references('id')->on('directores')
                   // ->onDelete('set null')
                   // ->onUpdate('cascade');

          //  $table->foreign('idGenero', 'idGenero_idx')
               //     ->references('id')->on('generos')
                //    ->onDelete('set null')
                  //  ->onUpdate('cascade');
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
>>>>>>> THEIRS
