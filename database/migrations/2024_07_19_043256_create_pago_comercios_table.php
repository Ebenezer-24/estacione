<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagoComerciosTable extends Migration
{
    public function up()
    {
        Schema::create('pago_comercios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comercio_id');
            $table->date('fecha_desde');
            $table->date('fecha_hasta');
            $table->decimal('importe', 10, 2);
            $table->timestamps();

            $table->foreign('comercio_id')->references('id')->on('comercios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pago_comercios');
    }
}
