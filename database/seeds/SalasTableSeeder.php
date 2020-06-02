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
           'numSala' => '1',
           'aforo' => '15'
        ]);
        Salas::create([
           'numSala' => '2',
           'aforo' => '30'
        ]);
    }
}
