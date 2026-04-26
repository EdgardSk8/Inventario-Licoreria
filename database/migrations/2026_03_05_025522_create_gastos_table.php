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

                $table->string('nombre_gasto', 150);
                $table->string('descripcion_gasto', 200)->nullable();

                $table->boolean('estado_gasto')->default(true);

                // relaciones
                $table->foreign('id_tipo_gasto')
                    ->references('id_tipo_gasto')
                    ->on('tipo_gasto');
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
