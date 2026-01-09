<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario administrador de prueba
        User::create([
            'name' => 'Admin Isa',
            'email' => 'admin@isa.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Crear usuario cliente de prueba
        User::create([
            'name' => 'Cliente Prueba',
            'email' => 'cliente@test.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Usuarios de prueba creados');

        // Orden importante: primero las tablas independientes
        $this->call([
            CategoriaSeeder::class,
            MaterialSeeder::class,
            ColorSeeder::class,
            TallaSeeder::class,
            VestidoSeeder::class,
        ]);

        $this->command->info('✅ Base de datos poblada exitosamente!');
        $this->command->warn('📧 Login: admin@isa.com / password123');
    }
}