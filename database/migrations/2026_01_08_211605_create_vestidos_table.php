<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vestidos', function (Blueprint $table) {
            $table->id();
            
            // Información básica
            $table->string('codigo', 50)->unique(); 
            $table->string('nombre', 200);
            $table->string('slug', 200)->unique();
            $table->text('descripcion')->nullable();
            
            // Relaciones
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('restrict');
            $table->foreignId('material_id')->nullable()->constrained('materials')->onDelete('set null');
            
            // Precios (en centavos para evitar problemas de decimales)
            $table->integer('precio_venta')->nullable()->comment('Precio en centavos');
            $table->integer('precio_alquiler')->nullable()->comment('Precio alquiler en centavos');
            
            // Inventario
            $table->integer('stock')->default(0);
            $table->integer('stock_minimo')->default(1);
            $table->boolean('es_unico')->default(false)->comment('Si es pieza única o hay stock');
            
            // Estado
            $table->enum('estado', ['disponible', 'alquilado', 'vendido', 'mantenimiento', 'inactivo'])
                  ->default('disponible');
            $table->boolean('destacado')->default(false);
            $table->boolean('nuevo')->default(false);
            
            // SEO
            $table->string('meta_title', 200)->nullable();
            $table->text('meta_description')->nullable();
            
            // Estadísticas
            $table->integer('vistas')->default(0);
            $table->integer('ventas')->default(0);
            $table->integer('alquileres')->default(0);
            
            $table->timestamps();
            $table->softDeletes();

            // Índices para búsquedas y filtros
            $table->index('codigo');
            $table->index('slug');
            $table->index('categoria_id');
            $table->index('estado');
            $table->index('destacado');
            $table->index(['precio_venta', 'precio_alquiler']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vestidos');
    }
};
