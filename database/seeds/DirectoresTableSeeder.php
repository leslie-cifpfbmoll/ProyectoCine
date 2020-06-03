<?php

use Illuminate\Database\Seeder;
use App\Directores;
class DirectoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('directores')->delete();
        
        Directores::create([
           'nombre' => 'Woody',
           'apellido' => 'Allen'
        ]);
        Directores::create([
           'nombre' => 'Steven',
           'apellido' => 'Spielberg'
        ]);
        Directores::create([
           'nombre' => 'Cate',
           'apellido' => 'Shortland'
        ]);
        Directores::create([
           'nombre' => 'Joseph',
           'apellido' => 'Kosinski'
        ]);
    }
}
