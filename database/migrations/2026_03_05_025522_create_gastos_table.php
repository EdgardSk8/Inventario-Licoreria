<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('gastos', function (Blueprint $table) {
            $table->increments('id_gasto');

            $table->unsignedInteger('id_tipo_gasto');

            $table->string('descripcion_gasto',200);

            $table->decimal('monto_gasto',10,2);

            $table->dateTime('fecha_gasto')->useCurrent();

            $table->unsignedInteger('id_usuario');
            $table->unsignedInteger('id_caja');

            $table->foreign('id_tipo_gasto')
                  ->references('id_tipo_gasto')
                  ->on('tipo_gasto');

            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuarios');

            $table->foreign('id_caja')
                  ->references('id_caja')
                  ->on('cajas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gastos');
    }
}
