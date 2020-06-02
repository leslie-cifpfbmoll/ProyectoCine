<?php

use Illuminate\Database\Seeder;
use App\Horarios;

class HorariosTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('horarios')->delete();
        Horarios::create([
            'hora' => '11:00:00',
        ]);
        Horarios::create([
            'hora' => '12:00:00',
        ]);
        Horarios::create([
            'hora' => '13:00:00',
        ]);
        Horarios::create([
            'hora' => '14:00:00',
        ]);
       
    }

}
