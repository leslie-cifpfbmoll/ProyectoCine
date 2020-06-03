<?php

use Illuminate\Database\Seeder;
use App\Precios;
class PreciosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('precios')->delete();
         Precios::create([
           'tipo' => 'General',
           'precio' => '7'
        ]);
        Precios::create([
           'tipo' => 'Miércoles',
           'precio' => '4'
        ]);
        Precios::create([
           'tipo' => 'Estrenos',
           'precio' => '10'
        ]);
    }
}
