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
            ['email' => 'admin@crea-pr.org.br'],
            [
                'name' => 'Admin CREA-PR',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
                'is_temporary_password' => false,
                'must_change_password' => false,
            ]
        );

        // Popular perguntas diagnósticas
        $this->call(DiagnosticQuestionsSeeder::class);
    }
}
