<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vestido_color', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vestido_id')->constrained('vestidos')->onDelete('cascade');
            $table->foreignId('color_id')->constrained('colors')->onDelete('cascade');
            $table->timestamps();

            // Un vestido no puede tener el mismo color duplicado
            $table->unique(['vestido_id', 'color_id']);
            
            $table->index('vestido_id');
            $table->index('color_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vestido_color');
    }
};
