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
        Schema::create('credenciales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_empresa', 150);
            $table->string('ruc_empresa', 20)->nullable();
            $table->string('direccion_empresa', 200)->nullable();
            $table->string('telefono_empresa', 20)->nullable();
            $table->string('correo_empresa', 100)->nullable();
            $table->decimal('tipo_cambio', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credenciales');
    }
};
