<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('devoluciones', function (Blueprint $table) {
            $table->id('id_devolucion');

            // 🔗 Relaciones
            $table->integer('id_venta')->unsigned();
            $table->integer('id_producto')->unsigned();
            $table->integer('id_usuario')->unsigned();

            // 📦 Datos de devolución
            $table->integer('cantidad');
            $table->decimal('monto', 10, 2);
            $table->string('motivo', 150)->nullable();

            // 📅 Fecha
            $table->dateTime('fecha')->useCurrent();

            // 🔐 Llaves foráneas
            $table->foreign('id_venta')
                  ->references('id_venta')
                  ->on('ventas')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->foreign('id_producto')
                  ->references('id_producto')
                  ->on('productos')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuarios')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->index(['id_venta', 'id_producto']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devoluciones');
    }
};
