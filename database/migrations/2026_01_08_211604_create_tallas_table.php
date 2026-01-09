<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tallas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 20); 
            $table->string('equivalencia', 50)->nullable(); 
            $table->text('descripcion')->nullable(); 
            $table->integer('orden')->default(0); 
            $table->boolean('activo')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index('nombre');
            $table->index('orden');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tallas');
    }
};
