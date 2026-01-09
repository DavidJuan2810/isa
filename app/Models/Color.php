<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'codigo_hex',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function vestidos()
    {
        return $this->belongsToMany(Vestido::class, 'vestido_color');
    }

    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }
}
