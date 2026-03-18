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
         Schema::create('ubicaciones', function (Blueprint $table) {
            $table->increments('id_ubicacion');
            $table->string('nombre_ubicacion', 100);
            $table->string('descripcion_ubicacion', 150)->nullable();
            $table->boolean('estado_ubicacion')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubicaciones');
    }
};
