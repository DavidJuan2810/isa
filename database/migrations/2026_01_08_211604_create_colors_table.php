<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50); // Ej: Blanco, Negro, Rojo
            $table->string('codigo_hex', 7)->nullable(); // Ej: #FFFFFF, #000000
            $table->boolean('activo')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index('nombre');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('colors');
    }
};
