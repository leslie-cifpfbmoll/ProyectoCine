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
           'numFilas' => '28',
           'numColumnas' => '30'
        ]);
    }
}
