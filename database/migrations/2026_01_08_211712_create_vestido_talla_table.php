<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vestido_talla', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vestido_id')->constrained('vestidos')->onDelete('cascade');
            $table->foreignId('talla_id')->constrained('tallas')->onDelete('cascade');
            $table->integer('stock')->default(0)->comment('Stock específico para esta talla');
            $table->timestamps();

            // Un vestido no puede tener la misma talla duplicada
            $table->unique(['vestido_id', 'talla_id']);
            
            $table->index('vestido_id');
            $table->index('talla_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vestido_talla');
    }
};
