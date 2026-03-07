<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosInventarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos_inventario', function (Blueprint $table) {
            $table->increments('id_movimiento_inventario');

            $table->unsignedInteger('id_producto');

            $table->enum('tipo_movimiento',['ENTRADA','SALIDA','AJUSTE']);

            $table->integer('cantidad_movimiento');
            $table->string('motivo_movimiento',150)->nullable();

            $table->integer('id_referencia')->nullable();

            $table->dateTime('fecha_movimiento')->useCurrent();

            $table->unsignedInteger('id_usuario');

            $table->foreign('id_producto')
                  ->references('id_producto')
                  ->on('productos');

            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientos_inventario');
    }
}
