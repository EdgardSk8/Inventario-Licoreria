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
        Schema::create('cuentas', function (Blueprint $table) {
            
            $table->increments('id_cuenta');

            $table->string('nombre_cuenta', 100);

            // tipo libre (no enum)
            $table->string('tipo_cuenta', 50)->nullable();

            $table->text('descripcion')->nullable();

            $table->decimal('saldo_actual', 10, 2)->default(0);

            $table->boolean('estado')->default(true);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentas');
    }
};
