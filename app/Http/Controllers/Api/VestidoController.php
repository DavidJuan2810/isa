<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VestidoResource;
use App\Models\Vestido;
use Illuminate\Http\Request;

class VestidoController extends Controller
{
    /**
     * Listar todos los vestidos con filtros
     */
    public function index(Request $request)
    {
        $query = Vestido::query()
            ->with(['categoria', 'material', 'colores', 'tallas', 'imagenes']);

        // Filtro por categoría
        if ($request->has('categoria')) {
            $query->whereHas('categoria', function ($q) use ($request) {
                $q->where('slug', $request->categoria);
            });
        }

        // Filtro por estado
        if ($request->has('estado')) {
            $query->where('estado', $request->estado);
        } else {
            // Por defecto, solo disponibles
            $query->disponibles();
        }

        // Filtro por destacados
        if ($request->boolean('destacados')) {
            $query->destacados();
        }

        // Filtro por nuevos
        if ($request->boolean('nuevos')) {
            $query->nuevos();
        }

        // Búsqueda por texto
        if ($request->has('buscar')) {
            $query->buscar($request->buscar);
        }

        // Filtro por rango de precio (en centavos)
        if ($request->has('precio_min')) {
            $query->where('precio_venta', '>=', $request->precio_min);
        }
        if ($request->has('precio_max')) {
            $query->where('precio_venta', '<=', $request->precio_max);
        }

        // Ordenamiento
        $sortBy = $request->get('ordenar', 'created_at');
        $sortOrder = $request->get('orden', 'desc');
        
        switch ($sortBy) {
            case 'precio_menor':
                $query->orderBy('precio_venta', 'asc');
                break;
            case 'precio_mayor':
                $query->orderBy('precio_venta', 'desc');
                break;
            case 'nombre':
                $query->orderBy('nombre', 'asc');
                break;
            case 'mas_vendidos':
                $query->orderBy('ventas', 'desc');
                break;
            default:
                $query->orderBy($sortBy, $sortOrder);
        }

        // Paginación
        $perPage = $request->get('por_pagina', 12);
        $vestidos = $query->paginate($perPage);

        return VestidoResource::collection($vestidos);
    }

    /**
     * Mostrar un vestido específico
     */
    public function show($slug)
    {
        $vestido = Vestido::where('slug', $slug)
            ->with(['categoria', 'material', 'colores', 'tallas', 'imagenes'])
            ->firstOrFail();

        // Incrementar contador de vistas
        $vestido->incrementarVistas();

        return new VestidoResource($vestido);
    }

    /**
     * Obtener vestidos relacionados
     */
    public function relacionados($slug)
    {
        $vestido = Vestido::where('slug', $slug)->firstOrFail();

        $relacionados = Vestido::where('categoria_id', $vestido->categoria_id)
            ->where('id', '!=', $vestido->id)
            ->disponibles()
            ->with(['categoria', 'material', 'colores', 'imagenes'])
            ->limit(4)
            ->get();

        return VestidoResource::collection($relacionados);
    }

    /**
     * Obtener vestidos destacados
     */
    public function destacados()
    {
        $vestidos = Vestido::destacados()
            ->with(['categoria', 'material', 'colores', 'imagenes'])
            ->limit(8)
            ->get();

        return VestidoResource::collection($vestidos);
    }

    /**
     * Obtener vestidos nuevos
     */
    public function nuevos()
    {
        $vestidos = Vestido::nuevos()
            ->with(['categoria', 'material', 'colores', 'imagenes'])
            ->limit(8)
            ->get();

        return VestidoResource::collection($vestidos);
    }
}