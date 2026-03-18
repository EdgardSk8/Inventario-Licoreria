<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id_producto');
            $table->string('nombre_producto',150);
            $table->string('descripcion_producto',200)->nullable();

            $table->unsignedInteger('id_categoria');
            $table->unsignedInteger('id_impuesto');
            $table->unsignedInteger('id_ubicacion')->nullable();
            $table->string('imagen_producto')->nullable();

            $table->decimal('precio_compra',10,2);
            $table->decimal('precio_venta',10,2);
            $table->integer('stock_actual')->default(0);

            $table->boolean('estado_producto')->default(true);
            $table->dateTime('fecha_creacion_producto')->useCurrent();

            // 🔗 Relaciones
            $table->foreign('id_categoria')
                  ->references('id_categoria')
                  ->on('categoria');

            $table->foreign('id_impuesto')
                  ->references('id_impuesto')
                  ->on('impuestos');

            $table->foreign('id_ubicacion') // 👈 NUEVA RELACIÓN
                  ->references('id_ubicacion')
                  ->on('ubicaciones')
                  ->onDelete('set null'); // 👈 recomendable
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
