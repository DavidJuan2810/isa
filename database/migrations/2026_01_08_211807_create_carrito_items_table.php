<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carrito_items', function (Blueprint $table) {
            $table->id();
            
            // Usuario (puede ser null para invitados con session)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('session_id', 100)->nullable()->comment('Para usuarios no autenticados');
            
            // Producto
            $table->foreignId('vestido_id')->constrained('vestidos')->onDelete('cascade');
            $table->foreignId('talla_id')->nullable()->constrained('tallas')->onDelete('set null');
            
            // Tipo de transacción
            $table->enum('tipo', ['venta', 'alquiler'])->default('venta');
            
            // Fechas (para alquileres)
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            
            // Cantidad y precio
            $table->integer('cantidad')->default(1);
            $table->integer('precio')->comment('Precio en centavos al momento de agregar');
            
            $table->timestamps();

            // Índices
            $table->index('user_id');
            $table->index('session_id');
            $table->index('vestido_id');
            
            // Un usuario no puede tener el mismo vestido duplicado en el carrito
            $table->unique(['user_id', 'vestido_id', 'tipo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrito_items');
    }
};
