<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('imagen_vestidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vestido_id')->constrained('vestidos')->onDelete('cascade');
            
            $table->string('ruta', 500); 
            $table->string('nombre_original', 200)->nullable();
            $table->string('tipo', 50)->nullable(); 
            $table->integer('orden')->default(0); 
            $table->string('alt_text', 200)->nullable(); 
            
            $table->timestamps();

            $table->index('vestido_id');
            $table->index(['vestido_id', 'orden']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imagen_vestidos');
    }
};
