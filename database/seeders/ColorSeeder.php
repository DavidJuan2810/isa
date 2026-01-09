<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    public function run(): void
    {
        $colores = [
            ['nombre' => 'Blanco', 'codigo_hex' => '#FFFFFF', 'activo' => true],
            ['nombre' => 'Marfil', 'codigo_hex' => '#FFFFF0', 'activo' => true],
            ['nombre' => 'Negro', 'codigo_hex' => '#000000', 'activo' => true],
            ['nombre' => 'Rojo', 'codigo_hex' => '#DC143C', 'activo' => true],
            ['nombre' => 'Azul', 'codigo_hex' => '#0000FF', 'activo' => true],
            ['nombre' => 'Rosa', 'codigo_hex' => '#FFC0CB', 'activo' => true],
            ['nombre' => 'Dorado', 'codigo_hex' => '#FFD700', 'activo' => true],
            ['nombre' => 'Plateado', 'codigo_hex' => '#C0C0C0', 'activo' => true],
            ['nombre' => 'Verde', 'codigo_hex' => '#008000', 'activo' => true],
            ['nombre' => 'Morado', 'codigo_hex' => '#800080', 'activo' => true],
            ['nombre' => 'Coral', 'codigo_hex' => '#FF7F50', 'activo' => true],
            ['nombre' => 'Champagne', 'codigo_hex' => '#F7E7CE', 'activo' => true],
            ['nombre' => 'Nude', 'codigo_hex' => '#E3BC9A', 'activo' => true],
            ['nombre' => 'Borgoña', 'codigo_hex' => '#800020', 'activo' => true],
            ['nombre' => 'Turquesa', 'codigo_hex' => '#40E0D0', 'activo' => true],
        ];

        foreach ($colores as $color) {
            Color::create($color);
        }

        $this->command->info('✅ Colores creados: ' . count($colores));
    }
}
