<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'slug' => $this->slug,
            'descripcion' => $this->descripcion,
            'icono' => $this->icono,
            'activo' => $this->activo,
            'orden' => $this->orden,
            'cantidad_vestidos' => $this->vestidos_count ?? $this->vestidos()->count(),
        ];
    }
}
