<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Peliculas;
use App\Carrousel;

class CarouselSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('carrousel')->delete();

        $peliUno = Peliculas::where('nombre', 'Wonder Woman 1984')->first();
        $peliDos = Peliculas::where('nombre', 'Viuda Negra')->first();
        $peliTres = Peliculas::where('nombre', 'Mulán')->first();
        $peliCuatro = Peliculas::where('nombre', 'Top Gun')->first();

        $carrouselUno = Carrousel::create([
                    'mime' => 'image/png',
                    'filename' => 'ww_c.png'
        ]);
        $carrouselDos = Carrousel::create([
                    'mime' => 'image/png',
                    'filename' => 'viuda_negra_c.png'
        ]);
        $carrouselTres = Carrousel::create([
                    'mime' => 'image/png',
                    'filename' => 'mulan_c.png'
        ]);
        $carrouselCuatro = Carrousel::create([
                    'mime' => 'image/png',
                    'filename' => 'tp_gun_c.png'
        ]);

        $carrouselUno->peliculas()->attach($peliUno);
        $carrouselDos->peliculas()->attach($peliDos);
        $carrouselTres->peliculas()->attach($peliTres);
        $carrouselCuatro->peliculas()->attach($peliCuatro);
    }

}
