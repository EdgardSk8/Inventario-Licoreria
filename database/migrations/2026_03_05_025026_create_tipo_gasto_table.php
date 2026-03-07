<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoGastoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_gasto', function (Blueprint $table) {
            $table->increments('id_tipo_gasto');
            $table->string('nombre_tipo_gasto', 100)->unique();
            $table->string('descripcion_tipo_gasto', 150)->nullable();
            $table->boolean('estado_tipo_gasto')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_gasto');
    }
}
