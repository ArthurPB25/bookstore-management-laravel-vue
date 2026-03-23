<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Limpa o cache de permissões do Spatie (evita erros de permissão não encontrada)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Cria as Roles (Perfis) definidas no desafio
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $editorRole = Role::firstOrCreate(['name' => 'editor']);

        // Cria o Usuário Administrador (Acesso Total)
        $admin = User::firstOrCreate(
            ['email' => 'admin@livraria.com'],
            [
                'name' => 'Admin Teste',
                'password' => Hash::make('password'), // Senha padrão exigida para o README
            ]
        );
        $admin->assignRole($adminRole);

        // Cria o Usuário Editor (Pode criar/editar, não pode excluir)
        $editor = User::firstOrCreate(
            ['email' => 'editor@livraria.com'],
            [
                'name' => 'Editor Teste',
                'password' => Hash::make('password'),
            ]
        );
        $editor->assignRole($editorRole);
    }
}