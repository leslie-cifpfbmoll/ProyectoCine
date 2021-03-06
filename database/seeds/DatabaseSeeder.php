<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call(RolesTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(DirectoresTableSeeder::class);
        $this->call(SalasTableSeeder::class);
        $this->call(PreciosTableSeeder::class);
        $this->call(GenerosTableSeeder::class);
        $this->call(PeliculasTableSeeder::class);
        $this->call(HorariosTableSeeder::class);
        $this->call(CarouselSeeder::class);
        //$this->call(ReservasTableSeeder::class);
    }

}
