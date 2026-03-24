<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criar usuário admin do sistema (se não existir)
        User::firstOrCreate(
            ['email' => 'kawanhrs@gmail.com'],
            [
                'name' => 'Kawan Harshe Kakubo',
                'password' => bcrypt('kawan1203'),
                'role' => 'admin',
                'is_temporary_password' => false,
                'must_change_password' => false,
            ]
        );
    }
}
