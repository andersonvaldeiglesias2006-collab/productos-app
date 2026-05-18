<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,       // 1° usuarios
            CategoriaSeeder::class,  // 2° categorías
            ProductoSeeder::class,   // 3° productos (dependen de categorías)
        ]);
    }
}