<?php

use Illuminate\Database\Seeder;
use App\Peliculas;
use App\Directores;
use App\Generos;

class PeliculasTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('peliculas')->delete();

        $aventuraGen = Generos::where('nombre', 'Aventura')->first();
        $dramaGen = Generos::where('nombre', 'Drama')->first();
        $horrorGen = Generos::where('nombre', 'Horror')->first();
        $documentalGen = Generos::where('nombre', 'Documental')->first();
        $aventuraGen = Generos::where('nombre', 'Aventura')->first();
        $comediaGen = Generos::where('nombre', 'Comedia')->first();

        $directorUno = Directores::where('nombre', 'Woody')->first();
        $directorDos = Directores::where('nombre', 'Steven')->first();

        $peliculaUno = Peliculas::create([
                    'nombre' => 'Parque Jurásico',
                    'estreno' => '1993-10-30',
                    'duracion' => '127',
                    'sinopsis' => 'Tres expertos y otras personas son invitados a un parque de diversiones, donde se encuentran dinosaurios creados en base al ADN.',
                    'filename' => 'phpC8C2.tmp.jpg',
                    'mime' => 'image/jpeg',
                    'original_filename' => 'null',
        ]);
        $peliculaDos = Peliculas::create([
                    'nombre' => 'El sueño de Cassandra',
                    'estreno' => '2007-10-26',
                    'duracion' => '108',
                    'sinopsis' => 'Una mujer seductora engaña a dos hermanos con problemas económicos, los lleva a experimentar una vida criminal y provoca una gran rivalidad entre ellos.',
                    'filename' => 'php3BCF.tmp.jpg',
                    'mime' => 'image/jpeg',
                    'original_filename' => 'null',
        ]);

        $peliculaUno->generos()->attach($aventuraGen);
        $peliculaUno->directores()->attach($directorDos);
        $peliculaDos->generos()->attach($documentalGen);
        $peliculaDos->directores()->attach($directorUno);
    }

}
