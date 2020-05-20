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

        $cartelera = Carteleras::where('fecha', '2020-05-20')->first();

        $reserva = Reservas::create([
                    'cantidad' => '5'
        ]);

        $reserva->usuarios()->attach($usuario);
        $reserva->carteleras()->attach($cartelera);
    }

}
