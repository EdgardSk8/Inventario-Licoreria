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
    public function up() {

        Schema::create('movimientos_inventario', function (Blueprint $table) {
            $table->increments('id_movimiento_inventario');
            $table->unsignedInteger('id_producto');
            $table->enum('tipo_movimiento', ['ENTRADA','SALIDA','AJUSTE']);
            $table->integer('cantidad_movimiento');
            $table->integer('stock_resultante');
            $table->string('motivo_movimiento',150)->nullable();
            $table->unsignedInteger('id_referencia')->nullable();
            $table->enum('tipo_referencia', ['VENTA','COMPRA','DEVOLUCION','TRASLADO','AJUSTE'])->nullable();
            $table->decimal('precio_unitario',10,2)->nullable();
            $table->dateTime('fecha_movimiento')->useCurrent();
            $table->unsignedInteger('id_usuario');

            // 🔗 relaciones
            $table->foreign('id_producto')
                ->references('id_producto')
                ->on('productos')
                ->onDelete('cascade');

            $table->foreign('id_usuario')
                ->references('id_usuario')
                ->on('usuarios')
                ->onDelete('cascade');
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
