<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'vestido_id',
        'talla_id',
        'nombre_vestido',
        'precio_unitario',
        'cantidad',
        'subtotal',
        'descuento',
    ];

    protected $casts = [
        'precio_unitario' => 'integer',
        'cantidad' => 'integer',
        'subtotal' => 'integer',
        'descuento' => 'integer',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function vestido()
    {
        return $this->belongsTo(Vestido::class);
    }

    public function talla()
    {
        return $this->belongsTo(Talla::class);
    }

    // Accessors
    public function getSubtotalFormateadoAttribute()
    {
        return '$' . number_format($this->subtotal / 100, 2);
    }

    public function getPrecioUnitarioFormateadoAttribute()
    {
        return '$' . number_format($this->precio_unitario / 100, 2);
    }

    // Métodos helper
    public function calcularSubtotal()
    {
        $this->subtotal = ($this->precio_unitario * $this->cantidad) - $this->descuento;
        $this->save();
    }
}
