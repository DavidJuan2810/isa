<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriaResource;
use App\Http\Resources\VestidoResource;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Listar todas las categorías activas
     */
    public function index()
    {
        $categorias = Categoria::activas()
            ->withCount('vestidos')
            ->get();

        return CategoriaResource::collection($categorias);
    }

    /**
     * Mostrar una categoría específica
     */
    public function show($slug)
    {
        $categoria = Categoria::where('slug', $slug)
            ->where('activo', true)
            ->withCount('vestidos')
            ->firstOrFail();

        return new CategoriaResource($categoria);
    }

    /**
     * Obtener vestidos de una categoría
     */
    public function vestidos($slug)
    {
        $categoria = Categoria::where('slug', $slug)
            ->where('activo', true)
            ->firstOrFail();

        $vestidos = $categoria->vestidos()
            ->disponibles()
            ->with(['categoria', 'material', 'colores', 'tallas', 'imagenes'])
            ->paginate(12);

        return VestidoResource::collection($vestidos);
    }
}