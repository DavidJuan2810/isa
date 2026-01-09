<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        $materiales = [
            ['nombre' => 'Seda', 'descripcion' => 'Tela natural suave y elegante', 'activo' => true],
            ['nombre' => 'Satén', 'descripcion' => 'Tela brillante y lisa', 'activo' => true],
            ['nombre' => 'Encaje', 'descripcion' => 'Tela decorativa con patrones', 'activo' => true],
            ['nombre' => 'Tul', 'descripcion' => 'Tela ligera y transparente', 'activo' => true],
            ['nombre' => 'Chiffon', 'descripcion' => 'Tela ligera y fluida', 'activo' => true],
            ['nombre' => 'Organza', 'descripcion' => 'Tela transparente y rígida', 'activo' => true],
            ['nombre' => 'Terciopelo', 'descripcion' => 'Tela suave con textura', 'activo' => true],
            ['nombre' => 'Crepe', 'descripcion' => 'Tela con textura arrugada', 'activo' => true],
            ['nombre' => 'Mikado', 'descripcion' => 'Tela estructurada y lujosa', 'activo' => true],
            ['nombre' => 'Georgette', 'descripcion' => 'Tela ligera y fluida', 'activo' => true],
        ];

        foreach ($materiales as $material) {
            Material::create($material);
        }

        $this->command->info('✅ Materiales creados: ' . count($materiales));
    }
}