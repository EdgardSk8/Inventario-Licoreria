<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetodosPagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metodos_pago', function (Blueprint $table) {
            $table->increments('id_metodo_pago');
            $table->string('nombre_metodo_pago', 100)->unique();
            $table->string('descripcion_metodo_pago', 150)->nullable();
            $table->boolean('estado_metodo_pago')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metodos_pago');
    }
}
