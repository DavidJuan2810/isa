<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VestidoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'slug' => $this->slug,
            'descripcion' => $this->descripcion,
            
            // Precios formateados
            'precio_venta' => $this->precio_venta,
            'precio_venta_formateado' => $this->precio_venta_formateado,
            'precio_alquiler' => $this->precio_alquiler,
            'precio_alquiler_formateado' => $this->precio_alquiler_formateado,
            
            // Inventario
            'stock' => $this->stock,
            'es_unico' => $this->es_unico,
            'estado' => $this->estado,
            'disponible' => $this->estaDisponible(),
            
            // Destacados
            'destacado' => $this->destacado,
            'nuevo' => $this->nuevo,
            
            // Relaciones
            'categoria' => new CategoriaResource($this->whenLoaded('categoria')),
            'material' => [
                'id' => $this->material?->id,
                'nombre' => $this->material?->nombre,
            ],
            'colores' => $this->whenLoaded('colores', function () {
                return $this->colores->map(function ($color) {
                    return [
                        'id' => $color->id,
                        'nombre' => $color->nombre,
                        'codigo_hex' => $color->codigo_hex,
                    ];
                });
            }),
            'tallas' => $this->whenLoaded('tallas', function () {
                return $this->tallas->map(function ($talla) {
                    return [
                        'id' => $talla->id,
                        'nombre' => $talla->nombre,
                        'stock' => $talla->pivot->stock,
                        'disponible' => $talla->pivot->stock > 0,
                    ];
                });
            }),
            'imagenes' => $this->whenLoaded('imagenes', function () {
                return $this->imagenes->map(function ($imagen) {
                    return [
                        'id' => $imagen->id,
                        'url' => $imagen->url,
                        'tipo' => $imagen->tipo,
                        'alt_text' => $imagen->alt_text,
                    ];
                });
            }),
            
            // Imagen principal
            'imagen_principal' => $this->imagen_principal?->url,
            
            // Estadísticas
            'vistas' => $this->vistas,
            'ventas' => $this->ventas,
            'alquileres' => $this->alquileres,
            
            // Timestamps
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}

