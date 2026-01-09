<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100); 
            $table->string('slug', 100)->unique(); 
            $table->text('descripcion')->nullable();
            $table->string('icono', 50)->nullable(); 
            $table->boolean('activo')->default(true);
            $table->integer('orden')->default(0); 
            $table->timestamps();
            $table->softDeletes();

            // Índices para búsquedas rápidas
            $table->index('slug');
            $table->index('activo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};