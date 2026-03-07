<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImpuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impuestos', function (Blueprint $table) {
            $table->increments('id_impuesto');
            $table->string('nombre_impuesto', 100)->unique();
            $table->decimal('porcentaje_impuesto', 5, 2);
            $table->boolean('estado_impuesto')->default(true);
            $table->dateTime('fecha_creacion_impuesto')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('impuestos');
    }
}
