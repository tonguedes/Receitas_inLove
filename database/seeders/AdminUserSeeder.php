<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@meusite.com'], // evita duplicar se já existir
            [
                'name' => 'Admin',
                'password' => Hash::make('senha123'), // troque para uma senha segura
                'is_admin' => true,
            ]
        );
    }
}
