<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarouselSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('carousel')->delete();
        DB::table('carousel')->insert([
            'filename' => 'ww_c.png',
            'mime' => 'image/png'
        ]);
        DB::table('carousel')->insert([
            'filename' => 'viuda_negra_c.png',
            'mime' => 'image/png'
        ]);
        DB::table('carousel')->insert([
            'filename' => 'mulan_c.png',
            'mime' => 'image/png'
        ]);
        DB::table('carousel')->insert([
            'filename' => 'tp_gun_c.png',
            'mime' => 'image/png'
        ]);
    }

}
