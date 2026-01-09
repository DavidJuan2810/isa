<?php

namespace Database\Seeders;

use App\Models\Vestido;
use App\Models\Categoria;
use App\Models\Material;
use App\Models\Color;
use App\Models\Talla;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VestidoSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = Categoria::all();
        $materiales = Material::all();
        $colores = Color::all();
        $tallas = Talla::all();

        $vestidos = [
            // MATRIMONIO
            [
                'nombre' => 'Vestido de Novia Princesa',
                'categoria' => 'matrimonio',
                'material' => 'Satén',
                'precio_venta' => 350000, // $3,500.00
                'precio_alquiler' => 80000, // $800.00
                'descripcion' => 'Elegante vestido de novia estilo princesa con cola larga y detalles de encaje',
                'stock' => 3,
                'colores' => ['Blanco', 'Marfil'],
                'destacado' => true,
                'nuevo' => true,
            ],
            [
                'nombre' => 'Vestido de Novia Sirena',
                'categoria' => 'matrimonio',
                'material' => 'Encaje',
                'precio_venta' => 420000,
                'precio_alquiler' => 95000,
                'descripcion' => 'Vestido estilo sirena con encaje delicado y escote corazón',
                'stock' => 2,
                'colores' => ['Blanco'],
                'destacado' => true,
                'nuevo' => false,
            ],
            [
                'nombre' => 'Vestido de Novia Boho',
                'categoria' => 'matrimonio',
                'material' => 'Chiffon',
                'precio_venta' => 280000,
                'precio_alquiler' => 65000,
                'descripcion' => 'Vestido bohemio ligero con mangas de encaje',
                'stock' => 4,
                'colores' => ['Marfil', 'Champagne'],
                'destacado' => false,
                'nuevo' => true,
            ],

            // QUINCEAÑERA
            [
                'nombre' => 'Vestido de Quinceañera Rosa Imperial',
                'categoria' => 'quinceanera',
                'material' => 'Tul',
                'precio_venta' => 250000,
                'precio_alquiler' => 55000,
                'descripcion' => 'Hermoso vestido de quinceañera con falda amplia y pedrería',
                'stock' => 5,
                'colores' => ['Rosa', 'Coral'],
                'destacado' => true,
                'nuevo' => false,
            ],
            [
                'nombre' => 'Vestido de Quinceañera Azul Cielo',
                'categoria' => 'quinceanera',
                'material' => 'Organza',
                'precio_venta' => 280000,
                'precio_alquiler' => 60000,
                'descripcion' => 'Vestido de quinceañera con corset bordado y falda de capas',
                'stock' => 3,
                'colores' => ['Azul', 'Turquesa'],
                'destacado' => true,
                'nuevo' => true,
            ],

            // GALA
            [
                'nombre' => 'Vestido de Gala Negro Elegante',
                'categoria' => 'gala',
                'material' => 'Terciopelo',
                'precio_venta' => 180000,
                'precio_alquiler' => 45000,
                'descripcion' => 'Vestido largo de gala en terciopelo con escote V',
                'stock' => 4,
                'colores' => ['Negro'],
                'destacado' => true,
                'nuevo' => false,
            ],
            [
                'nombre' => 'Vestido de Gala Rojo Pasión',
                'categoria' => 'gala',
                'material' => 'Satén',
                'precio_venta' => 195000,
                'precio_alquiler' => 48000,
                'descripcion' => 'Vestido de gala rojo con abertura lateral y espalda descubierta',
                'stock' => 2,
                'colores' => ['Rojo', 'Borgoña'],
                'destacado' => true,
                'nuevo' => true,
            ],

            // COCKTAIL
            [
                'nombre' => 'Vestido Cocktail Dorado',
                'categoria' => 'cocktail',
                'material' => 'Georgette',
                'precio_venta' => 95000,
                'precio_alquiler' => 28000,
                'descripcion' => 'Vestido corto de cocktail con lentejuelas doradas',
                'stock' => 6,
                'colores' => ['Dorado', 'Plateado'],
                'destacado' => false,
                'nuevo' => false,
            ],

            // FIESTA
            [
                'nombre' => 'Vestido de Fiesta Multicolor',
                'categoria' => 'fiesta',
                'material' => 'Crepe',
                'precio_venta' => 75000,
                'precio_alquiler' => 22000,
                'descripcion' => 'Vestido juvenil para fiestas con estampado floral',
                'stock' => 8,
                'colores' => ['Rosa', 'Verde', 'Coral'],
                'destacado' => false,
                'nuevo' => false,
            ],

            // GRADUACIÓN
            [
                'nombre' => 'Vestido de Graduación Blanco',
                'categoria' => 'graduacion',
                'material' => 'Chiffon',
                'precio_venta' => 85000,
                'precio_alquiler' => 25000,
                'descripcion' => 'Vestido midi elegante para ceremonias de graduación',
                'stock' => 7,
                'colores' => ['Blanco', 'Nude'],
                'destacado' => false,
                'nuevo' => true,
            ],
        ];

        $contador = 1;
        foreach ($vestidos as $vestidoData) {
            // Buscar categoría
            $categoria = $categorias->where('slug', $vestidoData['categoria'])->first();
            $material = $materiales->where('nombre', $vestidoData['material'])->first();

            // Crear vestido
            $vestido = Vestido::create([
                'codigo' => 'VES-' . str_pad($contador, 4, '0', STR_PAD_LEFT),
                'nombre' => $vestidoData['nombre'],
                'slug' => Str::slug($vestidoData['nombre']),
                'descripcion' => $vestidoData['descripcion'],
                'categoria_id' => $categoria->id,
                'material_id' => $material->id,
                'precio_venta' => $vestidoData['precio_venta'],
                'precio_alquiler' => $vestidoData['precio_alquiler'],
                'stock' => $vestidoData['stock'],
                'stock_minimo' => 1,
                'es_unico' => false,
                'estado' => 'disponible',
                'destacado' => $vestidoData['destacado'],
                'nuevo' => $vestidoData['nuevo'],
                'meta_title' => $vestidoData['nombre'] . ' - Isa Vestidos',
                'meta_description' => $vestidoData['descripcion'],
            ]);

            // Asociar colores
            $coloresIds = $colores->whereIn('nombre', $vestidoData['colores'])->pluck('id');
            $vestido->colores()->attach($coloresIds);

            // Asociar todas las tallas con stock aleatorio
            foreach ($tallas as $talla) {
                $vestido->tallas()->attach($talla->id, [
                    'stock' => rand(1, 3),
                ]);
            }

            $contador++;
        }

        $this->command->info('✅ Vestidos creados: ' . count($vestidos));
    }
}
