<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_pedidos', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade');
            $table->foreignId('vestido_id')->constrained('vestidos')->onDelete('restrict');
            $table->foreignId('talla_id')->nullable()->constrained('tallas')->onDelete('set null');
            
            // Información del producto al momento de la compra
            $table->string('nombre_vestido', 200); 
            $table->integer('precio_unitario'); 
            $table->integer('cantidad')->default(1);
            $table->integer('subtotal'); 
            
            // Descuentos específicos del item
            $table->integer('descuento')->default(0);
            
            $table->timestamps();

            $table->index('pedido_id');
            $table->index('vestido_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_pedidos');
    }
};
