<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            
            // Cliente
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Información de la cita
            $table->string('codigo_cita', 50)->unique(); // CITA-2026-0001
            $table->dateTime('fecha_hora');
            $table->integer('duracion')->default(60)->comment('Duración en minutos');
            
            // Vestidos de interés (opcional)
            $table->json('vestidos_interes')->nullable()->comment('IDs de vestidos que quiere ver');
            
            // Tipo de cita
            $table->enum('tipo', ['prueba', 'asesoria', 'devolucion', 'otro'])->default('prueba');
            
            // Estado
            $table->enum('estado', ['pendiente', 'confirmada', 'completada', 'cancelada', 'no_asistio'])
                  ->default('pendiente');
            
            // Notas
            $table->text('notas_cliente')->nullable();
            $table->text('notas_internas')->nullable();
            
            // Recordatorios
            $table->boolean('recordatorio_enviado')->default(false);
            
            $table->timestamps();
            $table->softDeletes();

            // Índices
            $table->index('codigo_cita');
            $table->index('user_id');
            $table->index('fecha_hora');
            $table->index('estado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};

