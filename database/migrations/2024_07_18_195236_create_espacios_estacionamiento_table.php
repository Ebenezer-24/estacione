<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspaciosEstacionamientoTable extends Migration
{
    public function up()
    {
        Schema::create('espacios_estacionamiento', function (Blueprint $table) {
            $table->id();
            $table->integer('numero')->unique();
            $table->string('estado')->default('Libre'); // Libre o Estacionado
            $table->timestamps();
        });

        // Insertar 30 espacios de estacionamiento
        for ($i = 1; $i <= 30; $i++) {
            DB::table('espacios_estacionamiento')->insert([
                'numero' => $i,
                'estado' => 'Libre',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down()
    {
        Schema::dropIfExists('espacios_estacionamiento');
    }
}