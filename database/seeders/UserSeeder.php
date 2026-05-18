<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        User::create([
            'name'     => 'Administrador',
            'email'    => 'admin@productosapp.com',
            'password' => Hash::make('admin123'), // Se cifra automáticamente
            'rol'      => 'admin',
        ]);

        User::create([
            'name'     => 'Usuario Demo',
            'email'    => 'demo@productosapp.com',
            'password' => Hash::make('demo123'),
            'rol'      => 'user',
        ]);

        $this->command->info('✔ Usuarios creados: admin@productosapp.com / admin123');
    }
}