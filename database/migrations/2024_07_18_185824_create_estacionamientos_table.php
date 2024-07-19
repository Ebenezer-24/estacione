<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstacionamientosTable extends Migration
{
    public function up()
    {
        Schema::create('estacionamientos', function (Blueprint $table) {
            $table->id();
            $table->string('patente')->nullable();
            $table->enum('estado', ['Estacionado', 'Libre'])->default('Libre');
            $table->integer('tiempo')->default(0); // tiempo en minutos
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estacionamientos');
    }
}