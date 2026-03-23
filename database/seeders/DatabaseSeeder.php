<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Chamamos os seeders específicos na ordem correta
        // Primeiro as permissões e usuários, depois as categorias de livros
        $this->call([
            RolesAndPermissionsSeeder::class,
            CategorySeeder::class,
        ]);
    }
}