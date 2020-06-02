<?php

use Illuminate\Database\Seeder;
use App\Salas;
class SalasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sala')->delete();
        
        Salas::create([
           'numFilas' => '20',
           'numColumnas' => '15'
        ]);
        Salas::create([
           'numFilas' => '20',
           'numColumnas' => '21'
        ]);
        Salas::create([
           'numFilas' => '18',
           'numColumnas' => '15'
        ]);
        Salas::create([
           'numFilas' => '10',
           'numColumnas' => '30'
        ]);
        Salas::create([
           'numFilas' => '18',
           'numColumnas' => '20'
        ]);
    }
}
