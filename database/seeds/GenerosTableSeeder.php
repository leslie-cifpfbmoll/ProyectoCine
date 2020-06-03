<?php

use Illuminate\Database\Seeder;
use App\Generos;
class GenerosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('generos')->delete();
        
        Generos::create([
           'nombre' => 'Aventura',
        ]); 
       Generos::create([
           'nombre' => 'Drama',
        ]);     
       Generos::create([
           'nombre' => 'Horror',
        ]); 
       Generos::create([
           'nombre' => 'Documental',
        ]); 
       Generos::create([
           'nombre' => 'Comedia',
        ]); 
       
       
       
       
    }
}
