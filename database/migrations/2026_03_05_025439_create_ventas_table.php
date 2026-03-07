<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id_venta');

            $table->string('numero_factura',50);

            $table->dateTime('fecha_venta')->useCurrent();

            $table->unsignedInteger('id_cliente')->nullable();
            $table->unsignedInteger('id_usuario');
            $table->unsignedInteger('id_caja');

            $table->decimal('subtotal_venta',10,2);
            $table->decimal('impuesto_venta',10,2);
            $table->decimal('total_venta',10,2);

            $table->boolean('estado_venta')->default(true);

            $table->unsignedInteger('id_metodo_pago');

            $table->foreign('id_cliente')
                  ->references('id_cliente')
                  ->on('clientes');

            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuarios');

            $table->foreign('id_caja')
                  ->references('id_caja')
                  ->on('cajas');

            $table->foreign('id_metodo_pago')
                  ->references('id_metodo_pago')
                  ->on('metodos_pago');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
