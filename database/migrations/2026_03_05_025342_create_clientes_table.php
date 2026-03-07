<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id_cliente');
            $table->string('nombre_cliente',150);
            $table->string('cedula_cliente',16)->unique()->nullable();
            $table->string('ruc_cliente',20)->unique()->nullable();
            $table->string('telefono_cliente',20)->nullable();
            $table->string('direccion_cliente',200)->nullable();
            $table->string('correo_cliente',100)->nullable();
            $table->boolean('estado_cliente')->default(true);
            $table->dateTime('fecha_creacion_cliente')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
