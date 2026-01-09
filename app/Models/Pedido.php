<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'numero_pedido',
        'tipo',
        'fecha_inicio',
        'fecha_fin',
        'fecha_devolucion',
        'subtotal',
        'descuento',
        'impuestos',
        'total',
        'estado',
        'direccion_entrega',
        'notas',
        'metodo_pago',
        'estado_pago',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'fecha_devolucion' => 'date',
        'subtotal' => 'integer',
        'descuento' => 'integer',
        'impuestos' => 'integer',
        'total' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class);
    }

    // Accessors
    public function getTotalFormateadoAttribute()
    {
        return '$' . number_format($this->total / 100, 2);
    }

    public function getSubtotalFormateadoAttribute()
    {
        return '$' . number_format($this->subtotal / 100, 2);
    }

    // Scopes
    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }

    public function scopeCompletados($query)
    {
        return $query->where('estado', 'completado');
    }

    public function scopeAlquileres($query)
    {
        return $query->where('tipo', 'alquiler');
    }

    public function scopeVentas($query)
    {
        return $query->where('tipo', 'venta');
    }

    // Métodos helper
    public function calcularTotal()
    {
        $this->subtotal = $this->detalles()->sum('subtotal');
        $this->total = $this->subtotal - $this->descuento + $this->impuestos;
        $this->save();
    }

    public function marcarComoPagado()
    {
        $this->update(['estado_pago' => 'pagado']);
    }

    public function estaVencido()
    {
        return $this->tipo === 'alquiler' 
            && $this->fecha_fin 
            && $this->fecha_fin->isPast()
            && !$this->fecha_devolucion;
    }
}

