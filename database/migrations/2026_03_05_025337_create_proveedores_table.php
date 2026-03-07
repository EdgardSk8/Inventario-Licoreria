<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->increments('id_proveedor');
            $table->string('nombre_proveedor',150);
            $table->string('ruc_proveedor',15)->unique()->nullable();
            $table->string('telefono_proveedor',20)->nullable();
            $table->string('direccion_proveedor',200)->nullable();
            $table->string('correo_proveedor',100)->nullable();
            $table->boolean('estado_proveedor')->default(true);
            $table->dateTime('fecha_creacion_proveedor')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
}
