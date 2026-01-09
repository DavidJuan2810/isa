<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Talla extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'equivalencia',
        'descripcion',
        'orden',
        'activo',
    ];

    protected $casts = [
        'orden' => 'integer',
        'activo' => 'boolean',
    ];

    public function vestidos()
    {
        return $this->belongsToMany(Vestido::class, 'vestido_talla')
                    ->withPivot('stock')
                    ->withTimestamps();
    }

    public function scopeActivas($query)
    {
        return $query->where('activo', true)->orderBy('orden');
    }
}
