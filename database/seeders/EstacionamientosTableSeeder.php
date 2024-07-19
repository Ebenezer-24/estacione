<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estacionamiento;

class EstacionamientosTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 30; $i++) {
            Estacionamiento::create([
                'patente' => null,
                'estado' => 'Libre',
                'tiempo' => 0,
            ]);
        }
    }
}

