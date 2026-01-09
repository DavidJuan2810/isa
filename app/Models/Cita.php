<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cita extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'codigo_cita',
        'fecha_hora',
        'duracion',
        'vestidos_interes',
        'tipo',
        'estado',
        'notas_cliente',
        'notas_internas',
        'recordatorio_enviado',
    ];

    protected $casts = [
        'fecha_hora' => 'datetime',
        'duracion' => 'integer',
        'vestidos_interes' => 'array',
        'recordatorio_enviado' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeProximas($query)
    {
        return $query->where('fecha_hora', '>', now())
                    ->whereIn('estado', ['pendiente', 'confirmada'])
                    ->orderBy('fecha_hora');
    }

    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }

    public function scopeConfirmadas($query)
    {
        return $query->where('estado', 'confirmada');
    }

    public function scopeHoy($query)
    {
        return $query->whereDate('fecha_hora', today());
    }

    // Métodos helper
    public function confirmar()
    {
        $this->update(['estado' => 'confirmada']);
    }

    public function cancelar()
    {
        $this->update(['estado' => 'cancelada']);
    }

    public function completar()
    {
        $this->update(['estado' => 'completada']);
    }

    public function estaProxima()
    {
        return $this->fecha_hora->isFuture();
    }
}
