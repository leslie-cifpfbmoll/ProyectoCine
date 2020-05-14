<?php

use Illuminate\Database\Seeder;
use App\horarios;

class HorariosTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('horarios')->delete();
        horarios::create([
            'hora' => '11:00:00',
        ]);
        horarios::create([
            'hora' => '12:00:00',
        ]);
        horarios::create([
            'hora' => '13:00:00',
        ]);
        horarios::create([
            'hora' => '14:00:00',
        ]);
       
    }

}