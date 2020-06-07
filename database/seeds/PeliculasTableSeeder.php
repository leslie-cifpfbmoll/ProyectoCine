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
        $directorTres = Directores::where('nombre', 'Joseph')->first();
        $directorCuatro = Directores::where('nombre', 'Cate')->first();
        $directorCinco = Directores::where('nombre', 'Patty')->first();
        $directorSeis = Directores::where('nombre', 'Niki')->first();

        $peliculaUno = Peliculas::create([
                    'nombre' => 'Parque Jurásico',
                    'estreno' => '1993-10-30',
                    'duracion' => '127',
                    'trailer' => 'https://www.youtube-nocookie.com/embed/nFMqT3f-3XU',
                    'sinopsis' => 'Tres expertos y otras personas son invitados a un parque de diversiones, donde se encuentran dinosaurios creados en base al ADN.',
                    'filename' => 'php17D5.tmp.jpg',
                    'mime' => 'image/jpeg',
                    'original_filename' => 'null',
        ]);
        $peliculaDos = Peliculas::create([
                    'nombre' => 'El sueño de Cassandra',
                    'estreno' => '2007-10-26',
                    'duracion' => '108',
                    'trailer' => 'https://www.youtube.com/embed/I7Gkrem5vPE',
                    'sinopsis' => 'Una mujer seductora engaña a dos hermanos con problemas económicos, los lleva a experimentar una vida criminal y provoca una gran rivalidad entre ellos.',
                    'filename' => 'php3A00.tmp.jpg',
                    'mime' => 'image/jpeg',
                    'original_filename' => 'null',
        ]);
        $peliculaTres = Peliculas::create([
                    'nombre' => 'Top Gun',
                    'estreno' => '2020-12-26',
                    'duracion' => '128',
                    'trailer' => 'https://www.youtube-nocookie.com/embed/9DAIhp6SoX8',
                    'sinopsis' => 'Treinta años más tarde, veremos al aviador de élite de la Marina de los Estados Unidos después de haberse convertido en uno de los mejores pilotos de la escuela de vuelo.',
                    'filename' => 'top_gun.jpg',
                    'mime' => 'image/jpeg',
                    'original_filename' => 'null',
        ]);
        $peliculaCuatro = Peliculas::create([
                    'nombre' => 'Viuda Negra',
                    'estreno' => '2020-10-30',
                    'duracion' => '120',
                    'trailer' => 'https://www.youtube-nocookie.com/embed/2zHzRBDlWxk',
                    'sinopsis' => 'Natasha Romanoff, alias Viuda Negra, se enfrenta a los capítulos más oscuros de su historia cuando surge una peligrosa conspiración relacionada con su pasado. Perseguida por una fuerza que no se detendrá ante nada para acabar con ella.',
                    'filename' => 'viuda_negra.jpg',
                    'mime' => 'image/jpeg',
                    'original_filename' => 'null',
        ]);
        $peliculaCinco = Peliculas::create([
                    'nombre' => 'Wonder Woman 1984',
                    'estreno' => '2020-08-14',
                    'duracion' => '140',
                    'trailer' => 'https://www.youtube.com/embed/V2HccMkmQdk',
                    'sinopsis' => 'En este nuevo capítulo, la princesa de Themyscira entablará amistad con Barbara Ann Minerva, una arqueóloga que trabaja para Max Lord, megalómano empeñado en recopilar artefactos antiguos con la creencia de que estos le harán tan poderosos como un Dios.',
                    'filename' => 'ww.jpg',
                    'mime' => 'image/jpeg',
                    'original_filename' => 'null',
        ]);
        $peliculaSeis = Peliculas::create([
                    'nombre' => 'Mulán',
                    'estreno' => '2020-07-27',
                    'duracion' => '90',
                    'trailer' => 'https://www.youtube.com/embed/0ATJYBoogHI',
                    'sinopsis' => 'El Emperador de China emite un decreto para reclutar a un varón por cada familia que deberá servir en el Ejército Imperial para defender al país de los invasores del Norte. Hua Mulán, hija única de un condecorado guerrero, se presenta para evitar que su anciano padre sea llamado a filas.',
                    'filename' => 'mulan.jpg',
                    'mime' => 'image/jpeg',
                    'original_filename' => 'null',
        ]);
        $peliculaUno->generos()->attach($aventuraGen);
        $peliculaUno->directores()->attach($directorDos);
        $peliculaDos->generos()->attach($documentalGen);
        $peliculaDos->directores()->attach($directorUno);
        $peliculaTres->generos()->attach($aventuraGen);
        $peliculaTres->directores()->attach($directorTres);
        $peliculaCuatro->generos()->attach($aventuraGen);
        $peliculaCuatro->directores()->attach($directorCuatro);
        $peliculaCinco->generos()->attach($aventuraGen);
        $peliculaCinco->directores()->attach($directorCinco);
        $peliculaSeis->generos()->attach($aventuraGen);
        $peliculaSeis->directores()->attach($directorSeis);
    }

}
