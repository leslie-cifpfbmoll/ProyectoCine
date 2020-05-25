<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Carteleras;
use App\Reservas;

class ReservasTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('reserva')->delete();
        DB::table('carteleras_reservas')->delete();
        DB::table('reservas_user')->delete();
        
        $usuario = User::where('name', 'user')->first();
        //$usuario1 = User::where('name', 'admin')->first();
        $cartelera = Carteleras::where('id', '1')->first();
        // $cartelera1 = Carteleras::where('id', '2')->first();

        $reserva = Reservas::create([
                    'cantidad' => '5'
        ]);
        // $reserva1 = Reservas::create([
        //     'cantidad' => '10'
        // ]);

        $reserva->usuarios()->attach($usuario);
        $reserva->carteleras()->attach($cartelera);
        // $reserva1->usuarios()->attach($usuario1);
        // $reserva1->carteleras()->attach($cartelera1);
     
    }

}
