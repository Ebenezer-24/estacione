<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dni')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('domicilio');
            $table->string('email')->unique();
            $table->date('fecha_nacimiento');
            $table->string('patente')->unique();
            $table->string('password');
            $table->decimal('saldo', 8, 2)->default(0.00);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}