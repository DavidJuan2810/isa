<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenVestido extends Model
{
    use HasFactory;

    protected $fillable = [
        'vestido_id',
        'ruta',
        'nombre_original',
        'tipo',
        'orden',
        'alt_text',
    ];

    protected $casts = [
        'orden' => 'integer',
    ];

    public function vestido()
    {
        return $this->belongsTo(Vestido::class);
    }

    public function getUrlAttribute()
    {
        return asset('storage/' . $this->ruta);
    }

    public function scopePrincipal($query)
    {
        return $query->where('tipo', 'principal');
    }
}
