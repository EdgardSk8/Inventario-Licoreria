<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosCajaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos_caja', function (Blueprint $table) {
            $table->increments('id_movimiento_caja');

            $table->unsignedInteger('id_caja');

            $table->enum('tipo_movimiento_caja',['INGRESO','SALIDA']);

            $table->string('concepto_movimiento_caja',150);

            $table->decimal('monto_movimiento_caja',10,2);

            $table->dateTime('fecha_movimiento_caja')->useCurrent();

            $table->unsignedInteger('id_usuario');

            $table->integer('id_referencia')->nullable();

            $table->foreign('id_caja')
                  ->references('id_caja')
                  ->on('cajas');

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
        Schema::dropIfExists('movimientos_caja');
    }
}
