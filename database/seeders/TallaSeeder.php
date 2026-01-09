<?php

namespace Database\Seeders;

use App\Models\Talla;
use Illuminate\Database\Seeder;

class TallaSeeder extends Seeder
{
    public function run(): void
    {
        $tallas = [
            [
                'nombre' => 'XS',
                'equivalencia' => '0-2',
                'descripcion' => 'Busto: 78-81cm, Cintura: 60-63cm, Cadera: 86-89cm',
                'orden' => 1,
                'activo' => true,
            ],
            [
                'nombre' => 'S',
                'equivalencia' => '4-6',
                'descripcion' => 'Busto: 84-87cm, Cintura: 66-69cm, Cadera: 92-95cm',
                'orden' => 2,
                'activo' => true,
            ],
            [
                'nombre' => 'M',
                'equivalencia' => '8-10',
                'descripcion' => 'Busto: 90-93cm, Cintura: 72-75cm, Cadera: 98-101cm',
                'orden' => 3,
                'activo' => true,
            ],
            [
                'nombre' => 'L',
                'equivalencia' => '12-14',
                'descripcion' => 'Busto: 96-99cm, Cintura: 78-81cm, Cadera: 104-107cm',
                'orden' => 4,
                'activo' => true,
            ],
            [
                'nombre' => 'XL',
                'equivalencia' => '16-18',
                'descripcion' => 'Busto: 102-107cm, Cintura: 84-89cm, Cadera: 110-115cm',
                'orden' => 5,
                'activo' => true,
            ],
            [
                'nombre' => 'XXL',
                'equivalencia' => '20-22',
                'descripcion' => 'Busto: 112-117cm, Cintura: 94-99cm, Cadera: 120-125cm',
                'orden' => 6,
                'activo' => true,
            ],
            [
                'nombre' => 'XXXL',
                'equivalencia' => '24-26',
                'descripcion' => 'Busto: 122-127cm, Cintura: 104-109cm, Cadera: 130-135cm',
                'orden' => 7,
                'activo' => true,
            ],
        ];

        foreach ($tallas as $talla) {
            Talla::create($talla);
        }

        $this->command->info('✅ Tallas creadas: ' . count($tallas));
    }
}
