<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'vestido_id',
        'talla_id',
        'tipo',
        'fecha_inicio',
        'fecha_fin',
        'cantidad',
        'precio',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'cantidad' => 'integer',
        'precio' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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
    public function getSubtotalAttribute()
    {
        return $this->precio * $this->cantidad;
    }

    public function getSubtotalFormateadoAttribute()
    {
        return '$' . number_format($this->subtotal / 100, 2);
    }

    public function getPrecioFormateadoAttribute()
    {
        return '$' . number_format($this->precio / 100, 2);
    }

    // Scopes
    public function scopeDelUsuario($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeDeLaSesion($query, $sessionId)
    {
        return $query->where('session_id', $sessionId);
    }
}
