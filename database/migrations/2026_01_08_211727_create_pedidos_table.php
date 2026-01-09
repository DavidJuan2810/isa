<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            
            // Cliente
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Información del pedido
            $table->string('numero_pedido', 50)->unique(); // PED-2026-0001
            $table->enum('tipo', ['venta', 'alquiler'])->default('venta');
            
            // Fechas (importante para alquileres)
            $table->date('fecha_inicio')->nullable()->comment('Para alquileres');
            $table->date('fecha_fin')->nullable()->comment('Para alquileres');
            $table->date('fecha_devolucion')->nullable()->comment('Fecha real de devolución');
            
            // Montos (en centavos)
            $table->integer('subtotal')->default(0);
            $table->integer('descuento')->default(0);
            $table->integer('impuestos')->default(0);
            $table->integer('total')->default(0);
            
            // Estado del pedido
            $table->enum('estado', [
                'pendiente',
                'confirmado',
                'preparando',
                'listo',
                'entregado',
                'devuelto',
                'cancelado',
                'completado'
            ])->default('pendiente');
            
            // Información de entrega
            $table->string('direccion_entrega', 500)->nullable();
            $table->text('notas')->nullable();
            
            // Pago
            $table->enum('metodo_pago', ['efectivo', 'tarjeta', 'transferencia', 'otro'])
                  ->nullable();
            $table->enum('estado_pago', ['pendiente', 'parcial', 'pagado', 'reembolsado'])
                  ->default('pendiente');
            
            $table->timestamps();
            $table->softDeletes();

            // Índices
            $table->index('numero_pedido');
            $table->index('user_id');
            $table->index('estado');
            $table->index('tipo');
            $table->index(['fecha_inicio', 'fecha_fin']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};