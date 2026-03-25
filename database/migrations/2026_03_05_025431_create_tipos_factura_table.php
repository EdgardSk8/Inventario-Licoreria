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
        Schema::create('tipos_factura', function (Blueprint $table) {
            $table->increments('id_tipo_factura');

            $table->string('nombre_tipo_factura', 50)->unique(); // Ej. CONTADO, CREDITO, EXENTO
            $table->string('descripcion_tipo_factura', 150)->nullable(); // Explicación del tipo
            $table->boolean('estado')->default(true); // Activo / Inactivo

            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_factura');
    }
};
