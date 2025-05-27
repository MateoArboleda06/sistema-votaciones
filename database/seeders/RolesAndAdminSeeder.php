<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RolesAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles
        $adminRole = Role::firstOrCreate(['name' => 'administrador']);
        $residenteRole = Role::firstOrCreate(['name' => 'residente']);

        // Crear usuario admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Principal',
                'password' => Hash::make('adminsecret'),
            ]
        );

        // Crear usuario residente
        $residente = User::firstOrCreate(
            ['email' => '201@example.com'],
            [
                'name' => 'Residente 201',
                'password' => Hash::make('secret201'),
            ]
        );

        // Asignar rol
        $admin->assignRole($adminRole);
        $residente->assignRole($residenteRole);
    }
}
