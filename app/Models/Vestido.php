<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vestido extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'codigo',
        'nombre',
        'slug',
        'descripcion',
        'categoria_id',
        'material_id',
        'precio_venta',
        'precio_alquiler',
        'stock',
        'stock_minimo',
        'es_unico',
        'estado',
        'destacado',
        'nuevo',
        'meta_title',
        'meta_description',
        'vistas',
        'ventas',
        'alquileres',
    ];

    protected $casts = [
        'precio_venta' => 'integer',
        'precio_alquiler' => 'integer',
        'stock' => 'integer',
        'stock_minimo' => 'integer',
        'es_unico' => 'boolean',
        'destacado' => 'boolean',
        'nuevo' => 'boolean',
        'vistas' => 'integer',
        'ventas' => 'integer',
        'alquileres' => 'integer',
    ];

    // Relaciones
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function imagenes()
    {
        return $this->hasMany(ImagenVestido::class)->orderBy('orden');
    }

    public function tallas()
    {
        return $this->belongsToMany(Talla::class, 'vestido_talla')
                    ->withPivot('stock')
                    ->withTimestamps();
    }

    public function colores()
    {
        return $this->belongsToMany(Color::class, 'vestido_color');
    }

    public function detallesPedidos()
    {
        return $this->hasMany(DetallePedido::class);
    }

    public function carritoItems()
    {
        return $this->hasMany(CarritoItem::class);
    }

    // Accessors - Convertir centavos a formato moneda
    public function getPrecioVentaFormateadoAttribute()
    {
        return $this->precio_venta ? '$' . number_format($this->precio_venta / 100, 2) : null;
    }

    public function getPrecioAlquilerFormateadoAttribute()
    {
        return $this->precio_alquiler ? '$' . number_format($this->precio_alquiler / 100, 2) : null;
    }

    public function getImagenPrincipalAttribute()
    {
        return $this->imagenes()->where('tipo', 'principal')->first() 
            ?? $this->imagenes()->first();
    }

    // Scopes
    public function scopeDisponibles($query)
    {
        return $query->where('estado', 'disponible')->where('stock', '>', 0);
    }

    public function scopeDestacados($query)
    {
        return $query->where('destacado', true)->where('estado', 'disponible');
    }

    public function scopeNuevos($query)
    {
        return $query->where('nuevo', true)->where('estado', 'disponible');
    }

    public function scopePorCategoria($query, $categoriaId)
    {
        return $query->where('categoria_id', $categoriaId);
    }

    public function scopeBuscar($query, $termino)
    {
        return $query->where('nombre', 'like', "%{$termino}%")
                    ->orWhere('descripcion', 'like', "%{$termino}%")
                    ->orWhere('codigo', 'like', "%{$termino}%");
    }

    // Métodos helper
    public function incrementarVistas()
    {
        $this->increment('vistas');
    }

    public function tieneStock()
    {
        return $this->stock > 0 && $this->estado === 'disponible';
    }

    public function estaDisponible()
    {
        return $this->estado === 'disponible' && $this->stock > 0;
    }
}
