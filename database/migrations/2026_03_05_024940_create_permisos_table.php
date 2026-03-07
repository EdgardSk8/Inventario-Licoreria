<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->increments('id_permiso');
            $table->string('nombre_permiso', 100)->unique();
            $table->string('descripcion_permiso', 150)->nullable();
            $table->string('modulo_permiso', 50);
            $table->boolean('estado_permiso')->default(true);
            $table->dateTime('fecha_creacion_permiso')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::dropIfExists('permisos');
    }
}
