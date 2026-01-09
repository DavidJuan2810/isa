<?php

namespace database\seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            [
                'nombre' => 'Matrimonio',
                'slug' => 'matrimonio',
                'descripcion' => 'Vestidos elegantes para novias y bodas',
                'icono' => 'icon-wedding',
                'activo' => true,
                'orden' => 1,
            ],
            [
                'nombre' => 'Quinceañera',
                'slug' => 'quinceanera',
                'descripcion' => 'Vestidos para celebraciones de 15 años',
                'icono' => 'icon-party',
                'activo' => true,
                'orden' => 2,
            ],
            [
                'nombre' => 'Gala',
                'slug' => 'gala',
                'descripcion' => 'Vestidos de gala para eventos formales',
                'icono' => 'icon-gala',
                'activo' => true,
                'orden' => 3,
            ],
            [
                'nombre' => 'Cocktail',
                'slug' => 'cocktail',
                'descripcion' => 'Vestidos semi-formales para cocteles',
                'icono' => 'icon-cocktail',
                'activo' => true,
                'orden' => 4,
            ],
            [
                'nombre' => 'Fiesta',
                'slug' => 'fiesta',
                'descripcion' => 'Vestidos casuales para fiestas',
                'icono' => 'icon-celebration',
                'activo' => true,
                'orden' => 5,
            ],
            [
                'nombre' => 'Graduación',
                'slug' => 'graduacion',
                'descripcion' => 'Vestidos para ceremonias de graduación',
                'icono' => 'icon-graduation',
                'activo' => true,
                'orden' => 6,
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }

        $this->command->info('✅ Categorías creadas: ' . count($categorias));
    }
}

