<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{
    User,
    Role,
    Priority,
    SolicitationType,
    ResponsibleTeam,
    CompanySegment,
    CompanyGroup,
    Company,
    Ticket
};

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Cria as roles primeiro
        $adminRole = Role::factory()->admin()->create();
        $clientRole = Role::factory()->client()->create();
        $employeeRole = Role::factory()->employee()->create();

        // Cria o usuário administrador principal
        $admin = User::factory()->create([
            'name' => 'Administrador',
            'email' => 'administrador@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => $adminRole->name,
        ]);

        // Cria 3 prioridades para o administrador
        $priorities = Priority::factory()
            ->count(3)
            ->forUser($admin)
            ->create();

        // Cria 3 tipos de solicitação para o administrador
        $solicitationTypes = SolicitationType::factory()
            ->count(3)
            ->forUser($admin)
            ->create();

        // Cria 3 equipes responsáveis para o administrador
        $teams = ResponsibleTeam::factory()
            ->count(3)
            ->forUser($admin)
            ->create();

        // Cria 3 segmentos de empresa para o administrador
        $segments = CompanySegment::factory()
            ->count(3)
            ->forUser($admin)
            ->create();

        // Cria 3 grupos de empresa para o administrador
        $groups = CompanyGroup::factory()
            ->count(3)
            ->forUser($admin)
            ->create();

        // Cria 3 empresas para o administrador, cada uma com um segmento e grupo diferente
        $companies = [];
        for ($i = 0; $i < 3; $i++) {
            $companies[] = Company::factory()
                ->forUser($admin)
                ->withCompanySegment($segments[$i])
                ->withCompanyGroup($groups[$i])
                ->create();
        }

        // Para cada empresa, cria 3 tickets
        foreach ($companies as $company) {
            Ticket::factory()
                ->count(3)
                ->forUser($admin)
                ->forCompany($company)
                ->withSolicitationType($solicitationTypes->random())
                ->withPriority($priorities->random())
                ->withResponsibleTeam($teams->random())
                ->create();
        }

        // Mensagem de confirmação
        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin user created:');
        $this->command->info('Email: administrador@gmail.com');
        $this->command->info('Password: admin123');
    }
}