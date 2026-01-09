<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'icono',
        'activo',
        'orden',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'orden' => 'integer',
    ];

    // Relaciones
    public function vestidos()
    {
        return $this->hasMany(Vestido::class);
    }

    // Scopes
    public function scopeActivas($query)
    {
        return $query->where('activo', true)->orderBy('orden');
    }
}