<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\{
    User,
    Priority,
    Role,
    ResponsibleTeam,
    SolicitationType,
    Company,
    CompanyGroup,
    CompanySegment,
};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'user',
            'active' => true,
            'deleted' => false,
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Cria um usuário com prioridades padrão
     */
    public function withPriorities(): static
    {
        return $this->afterCreating(function (User $user) {
            // Cria as prioridades padrão para o usuário
            $defaultPriorities = ['Baixa', 'Média', 'Alta'];
            
            foreach ($defaultPriorities as $priority) {
                Priority::factory()
                    ->forUser($user)
                    ->withName($priority)
                    ->create();
            }
        });
    }

    /**
     * Cria um usuário com prioridades customizadas
     */
    public function withCustomPriorities(array $priorities): static
    {
        return $this->afterCreating(function (User $user) use ($priorities) {
            foreach ($priorities as $priority) {
                Priority::factory()
                    ->forUser($user)
                    ->withName($priority)
                    ->create();
            }
        });
    }

    /**
     * Cria um usuário com X prioridades aleatórias
     */
    public function withRandomPriorities(int $count = 3): static
    {
        return $this->afterCreating(function (User $user) use ($count) {
            Priority::factory()
                ->count($count)
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário admin
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
        ]);
    }

    /**
     * Cria um usuário inativo
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'active' => false,
        ]);
    }

    // ========================================
    // MÉTODOS PARA ROLES
    // ========================================

    /**
     * Cria um usuário com uma role específica (por nome)
     */
    public function withRole(string $roleName): static
    {
        return $this->afterCreating(function (User $user) use ($roleName) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $user->update(['role' => $role->name]);
        });
    }

    /**
     * Cria um usuário com uma role específica (por ID)
     */
    public function withRoleId(int $roleId): static
    {
        return $this->afterCreating(function (User $user) use ($roleId) {
            $role = Role::find($roleId);
            if ($role) {
                $user->update(['role' => $role->name]);
            }
        });
    }

    /**
     * Cria um usuário com role de admin
     */
    public function adminRole(): static
    {
        return $this->withRole('Admin');
    }

    /**
     * Cria um usuário com role de cliente
     */
    public function clientRole(): static
    {
        return $this->withRole('Cliente');
    }

    /**
     * Cria um usuário com role de funcionário
     */
    public function employeeRole(): static
    {
        return $this->withRole('Funcionário');
    }

    /**
     * Cria um usuário com role aleatória
     */
    public function withRandomRole(): static
    {
        return $this->afterCreating(function (User $user) {
            $roles = ['Admin', 'Cliente', 'Funcionário'];
            $randomRole = $roles[array_rand($roles)];
            $role = Role::firstOrCreate(['name' => $randomRole]);
            $user->update(['role' => $role->name]);
        });
    }

    // ========================================
    // MÉTODOS COMBINADOS
    // ========================================

    /**
     * Cria um usuário admin completo (com role e prioridades)
     */
    public function fullAdmin(): static
    {
        return $this->adminRole()->withPriorities();
    }

    /**
     * Cria um usuário cliente completo (com role e prioridades)
     */
    public function fullClient(): static
    {
        return $this->clientRole()->withPriorities();
    }

    /**
     * Cria um usuário funcionário completo (com role e prioridades)
     */
    public function fullEmployee(): static
    {
        return $this->employeeRole()->withPriorities();
    }

    // ========================================
    // MÉTODOS PARA RESPONSIBLE TEAMS
    // ========================================

    /**
     * Cria um usuário com responsible teams padrão
     */
    public function withResponsibleTeams(): static
    {
        return $this->afterCreating(function (User $user) {
            // Cria equipes padrão para o usuário
            $defaultTeams = [
                'Equipe de Desenvolvimento',
                'Equipe de Suporte',
                'Equipe de Infraestrutura'
            ];
            
            foreach ($defaultTeams as $team) {
                ResponsibleTeam::factory()
                    ->forUser($user)
                    ->withName($team)
                    ->create();
            }
        });
    }

    /**
     * Cria um usuário com responsible teams customizados
     */
    public function withCustomResponsibleTeams(array $teams): static
    {
        return $this->afterCreating(function (User $user) use ($teams) {
            foreach ($teams as $team) {
                ResponsibleTeam::factory()
                    ->forUser($user)
                    ->withName($team)
                    ->create();
            }
        });
    }

    /**
     * Cria um usuário com X responsible teams aleatórios
     */
    public function withRandomResponsibleTeams(int $count = 3): static
    {
        return $this->afterCreating(function (User $user) use ($count) {
            ResponsibleTeam::factory()
                ->count($count)
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com equipe de desenvolvimento
     */
    public function withDevelopmentTeam(): static
    {
        return $this->afterCreating(function (User $user) {
            ResponsibleTeam::factory()
                ->development()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com equipe de suporte
     */
    public function withSupportTeam(): static
    {
        return $this->afterCreating(function (User $user) {
            ResponsibleTeam::factory()
                ->support()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com equipe de infraestrutura
     */
    public function withInfrastructureTeam(): static
    {
        return $this->afterCreating(function (User $user) {
            ResponsibleTeam::factory()
                ->infrastructure()
                ->forUser($user)
                ->create();
        });
    }

    // ========================================
    // MÉTODOS PARA SOLICITATION TYPES
    // ========================================

    /**
     * Cria um usuário com tipos de solicitação padrão
     */
    public function withSolicitationTypes(): static
    {
        return $this->afterCreating(function (User $user) {
            // Cria tipos de solicitação padrão para o usuário
            $defaultTypes = [
                'Suporte Técnico',
                'Solicitação de Acesso',
                'Manutenção',
                'Desenvolvimento'
            ];
            
            foreach ($defaultTypes as $type) {
                SolicitationType::factory()
                    ->forUser($user)
                    ->withName($type)
                    ->create();
            }
        });
    }

    /**
     * Cria um usuário com tipos de solicitação customizados
     */
    public function withCustomSolicitationTypes(array $types): static
    {
        return $this->afterCreating(function (User $user) use ($types) {
            foreach ($types as $type) {
                SolicitationType::factory()
                    ->forUser($user)
                    ->withName($type)
                    ->create();
            }
        });
    }

    /**
     * Cria um usuário com X tipos de solicitação aleatórios
     */
    public function withRandomSolicitationTypes(int $count = 3): static
    {
        return $this->afterCreating(function (User $user) use ($count) {
            SolicitationType::factory()
                ->count($count)
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com tipo de solicitação de suporte técnico
     */
    public function withTechnicalSupportType(): static
    {
        return $this->afterCreating(function (User $user) {
            SolicitationType::factory()
                ->technicalSupport()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com tipo de solicitação de desenvolvimento
     */
    public function withDevelopmentType(): static
    {
        return $this->afterCreating(function (User $user) {
            SolicitationType::factory()
                ->development()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com tipo de solicitação de manutenção
     */
    public function withMaintenanceType(): static
    {
        return $this->afterCreating(function (User $user) {
            SolicitationType::factory()
                ->maintenance()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com tipo de solicitação de consultoria
     */
    public function withConsultingType(): static
    {
        return $this->afterCreating(function (User $user) {
            SolicitationType::factory()
                ->consulting()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com tipo de solicitação de infraestrutura
     */
    public function withInfrastructureType(): static
    {
        return $this->afterCreating(function (User $user) {
            SolicitationType::factory()
                ->infrastructure()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com tipo de solicitação de segurança
     */
    public function withSecurityType(): static
    {
        return $this->afterCreating(function (User $user) {
            SolicitationType::factory()
                ->security()
                ->forUser($user)
                ->create();
        });
    }

    // ========================================
    // MÉTODOS PARA COMPANY GROUPS
    // ========================================

    /**
     * Cria um usuário com grupos de empresa padrão
     */
    public function withCompanyGroups(): static
    {
        return $this->afterCreating(function (User $user) {
            // Cria grupos de empresa padrão para o usuário
            $defaultGroups = [
                'Grupo Tecnologia',
                'Grupo Comercial',
                'Grupo Serviços',
                'Grupo Industrial'
            ];
            
            foreach ($defaultGroups as $group) {
                CompanyGroup::factory()
                    ->forUser($user)
                    ->withName($group)
                    ->create();
            }
        });
    }

    /**
     * Cria um usuário com grupos de empresa customizados
     */
    public function withCustomCompanyGroups(array $groups): static
    {
        return $this->afterCreating(function (User $user) use ($groups) {
            foreach ($groups as $group) {
                CompanyGroup::factory()
                    ->forUser($user)
                    ->withName($group)
                    ->create();
            }
        });
    }

    /**
     * Cria um usuário com X grupos de empresa aleatórios
     */
    public function withRandomCompanyGroups(int $count = 3): static
    {
        return $this->afterCreating(function (User $user) use ($count) {
            CompanyGroup::factory()
                ->count($count)
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com grupo de tecnologia
     */
    public function withTechnologyGroup(): static
    {
        return $this->afterCreating(function (User $user) {
            CompanyGroup::factory()
                ->technology()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com grupo financeiro
     */
    public function withFinancialGroup(): static
    {
        return $this->afterCreating(function (User $user) {
            CompanyGroup::factory()
                ->financial()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com grupo industrial
     */
    public function withIndustrialGroup(): static
    {
        return $this->afterCreating(function (User $user) {
            CompanyGroup::factory()
                ->industrial()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com grupo comercial
     */
    public function withCommercialGroup(): static
    {
        return $this->afterCreating(function (User $user) {
            CompanyGroup::factory()
                ->commercial()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com grupo de serviços
     */
    public function withServicesGroup(): static
    {
        return $this->afterCreating(function (User $user) {
            CompanyGroup::factory()
                ->services()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com grupo de logística
     */
    public function withLogisticsGroup(): static
    {
        return $this->afterCreating(function (User $user) {
            CompanyGroup::factory()
                ->logistics()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com grupo alimentício
     */
    public function withFoodGroup(): static
    {
        return $this->afterCreating(function (User $user) {
            CompanyGroup::factory()
                ->food()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com grupo farmacêutico
     */
    public function withPharmaceuticalGroup(): static
    {
        return $this->afterCreating(function (User $user) {
            CompanyGroup::factory()
                ->pharmaceutical()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com grupo educacional
     */
    public function withEducationalGroup(): static
    {
        return $this->afterCreating(function (User $user) {
            CompanyGroup::factory()
                ->educational()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com grupo hospitalar
     */
    public function withHospitalGroup(): static
    {
        return $this->afterCreating(function (User $user) {
            CompanyGroup::factory()
                ->hospital()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com grupo imobiliário
     */
    public function withRealEstateGroup(): static
    {
        return $this->afterCreating(function (User $user) {
            CompanyGroup::factory()
                ->realEstate()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com grupo automotivo
     */
    public function withAutomotiveGroup(): static
    {
        return $this->afterCreating(function (User $user) {
            CompanyGroup::factory()
                ->automotive()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com grupo de energia
     */
    public function withEnergyGroup(): static
    {
        return $this->afterCreating(function (User $user) {
            CompanyGroup::factory()
                ->energy()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com grupo de telecomunicações
     */
    public function withTelecommunicationsGroup(): static
    {
        return $this->afterCreating(function (User $user) {
            CompanyGroup::factory()
                ->telecommunications()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com grupo de construção
     */
    public function withConstructionGroup(): static
    {
        return $this->afterCreating(function (User $user) {
            CompanyGroup::factory()
                ->construction()
                ->forUser($user)
                ->create();
        });
    }

    // ========================================
    // MÉTODOS COMBINADOS AVANÇADOS
    // ========================================

    /**
     * Cria um usuário admin completo (com role, prioridades e teams)
     */
    public function fullAdminComplete(): static
    {
        return $this->adminRole()->withPriorities()->withResponsibleTeams();
    }

    /**
     * Cria um usuário cliente completo (com role, prioridades e teams)
     */
    public function fullClientComplete(): static
    {
        return $this->clientRole()->withPriorities()->withResponsibleTeams();
    }

    /**
     * Cria um usuário funcionário completo (com role, prioridades e teams)
     */
    public function fullEmployeeComplete(): static
    {
        return $this->employeeRole()->withPriorities()->withResponsibleTeams();
    }

    /**
     * Cria um usuário desenvolvedor completo
     */
    public function fullDeveloper(): static
    {
        return $this->employeeRole()
            ->withCustomPriorities(['Crítica', 'Alta', 'Média', 'Baixa'])
            ->withCustomResponsibleTeams([
                'Equipe de Desenvolvimento',
                'Equipe de Frontend',
                'Equipe de Backend',
                'Equipe de QA'
            ]);
    }

    /**
     * Cria um usuário de suporte completo
     */
    public function fullSupport(): static
    {
        return $this->employeeRole()
            ->withCustomPriorities(['Urgente', 'Alta', 'Média', 'Baixa'])
            ->withCustomResponsibleTeams([
                'Equipe de Suporte',
                'Equipe de Infraestrutura'
            ]);
    }

    /**
     * Cria um usuário super completo (com todas as relações)
     */
    public function fullUserComplete(): static
    {
        return $this->withPriorities()
            ->withResponsibleTeams()
            ->withSolicitationTypes()
            ->withCompanyGroups();
    }

    /**
     * Cria um usuário admin super completo
     */
    public function fullAdminSuper(): static
    {
        return $this->adminRole()
            ->withPriorities()
            ->withResponsibleTeams()
            ->withSolicitationTypes()
            ->withCompanyGroups();
    }

    /**
     * Cria um usuário cliente super completo
     */
    public function fullClientSuper(): static
    {
        return $this->clientRole()
            ->withPriorities()
            ->withResponsibleTeams()
            ->withSolicitationTypes()
            ->withCompanyGroups();
    }

    /**
     * Cria um usuário funcionário super completo
     */
    public function fullEmployeeSuper(): static
    {
        return $this->employeeRole()
            ->withPriorities()
            ->withResponsibleTeams()
            ->withSolicitationTypes()
            ->withCompanyGroups();
    }

    /**
     * Cria um usuário empresário completo
     */
    public function fullBusinessOwner(): static
    {
        return $this->employeeRole()
            ->withCustomPriorities(['Crítica', 'Alta', 'Média', 'Baixa'])
            ->withCustomCompanyGroups([
                'Grupo Tecnologia',
                'Grupo Financeiro',
                'Grupo Industrial',
                'Grupo Comercial'
            ])
            ->withCustomSolicitationTypes([
                'Consultoria Empresarial',
                'Análise de Mercado',
                'Desenvolvimento de Produto',
                'Suporte Técnico'
            ]);
    }

    /**
     * Cria um usuário gestor de grupos completo
     */
    public function fullGroupManager(): static
    {
        return $this->employeeRole()
            ->withCustomPriorities(['Estratégica', 'Operacional', 'Tática'])
            ->withCustomCompanyGroups([
                'Grupo Holding',
                'Grupo Subsidiárias',
                'Grupo Parcerias'
            ])
            ->withCustomResponsibleTeams([
                'Equipe de Gestão',
                'Equipe de Análise',
                'Equipe de Planejamento'
            ]);
    }

    // ========================================
    // MÉTODOS PARA COMPANY (EMPRESAS)
    // ========================================

    /**
     * Cria um usuário com uma empresa padrão
     */
    public function withCompany(): static
    {
        return $this->afterCreating(function (User $user) {
            Company::factory()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com X empresas
     */
    public function withCompanies(int $count = 1): static
    {
        return $this->afterCreating(function (User $user) use ($count) {
            Company::factory()
                ->count($count)
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com uma empresa de um tipo específico
     */
    public function withCompanyType(string $type): static
    {
        return $this->afterCreating(function (User $user) use ($type) {
            $method = lcfirst($type);
            
            if (method_exists(Company::factory(), $method)) {
                Company::factory()
                    ->$method()
                    ->forUser($user)
                    ->create();
            } else {
                Company::factory()
                    ->forUser($user)
                    ->create();
            }
        });
    }

    /**
     * Cria um usuário com uma empresa em uma localização específica
     */
    public function withCompanyInLocation(string $location): static
    {
        return $this->afterCreating(function (User $user) use ($location) {
            $method = 'in' . str_replace(' ', '', $location);
            
            if (method_exists(Company::factory(), $method)) {
                Company::factory()
                    ->$method()
                    ->forUser($user)
                    ->create();
            } else {
                Company::factory()
                    ->forUser($user)
                    ->create();
            }
        });
    }

    /**
     * Cria um usuário com uma empresa de um tamanho específico
     */
    public function withCompanySize(string $size): static
    {
        return $this->afterCreating(function (User $user) use ($size) {
            $method = lcfirst(str_replace(' ', '', $size)) . 'Company';
            
            if (method_exists(Company::factory(), $method)) {
                Company::factory()
                    ->$method()
                    ->forUser($user)
                    ->create();
            } else {
                Company::factory()
                    ->forUser($user)
                    ->create();
            }
        });
    }

    /**
     * Cria um usuário com uma empresa inativa
     */
    public function withInactiveCompany(): static
    {
        return $this->afterCreating(function (User $user) {
            Company::factory()
                ->inactive()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com uma empresa excluída
     */
    public function withDeletedCompany(): static
    {
        return $this->afterCreating(function (User $user) {
            Company::factory()
                ->deleted()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com uma empresa com segmento específico
     */
    public function withCompanyWithSegment(CompanySegment $segment): static
    {
        return $this->afterCreating(function (User $user) use ($segment) {
            Company::factory()
                ->withCompanySegment($segment)
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com uma empresa com grupo específico
     */
    public function withCompanyWithGroup(CompanyGroup $group): static
    {
        return $this->afterCreating(function (User $user) use ($group) {
            Company::factory()
                ->withCompanyGroup($group)
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com uma empresa com razão social específica
     */
    public function withCompanyWithCorporateReason(string $corporateReason): static
    {
        return $this->afterCreating(function (User $user) use ($corporateReason) {
            Company::factory()
                ->withCorporateReason($corporateReason)
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com uma empresa com nome fantasia específico
     */
    public function withCompanyWithFantasyName(string $fantasyName): static
    {
        return $this->afterCreating(function (User $user) use ($fantasyName) {
            Company::factory()
                ->withFantasyName($fantasyName)
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com uma empresa com CPF/CNPJ específico
     */
    public function withCompanyWithCpfCnpj(string $cpfCnpj): static
    {
        return $this->afterCreating(function (User $user) use ($cpfCnpj) {
            Company::factory()
                ->withCpfCnpj($cpfCnpj)
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com uma empresa com endereço específico
     */
    public function withCompanyWithAddress(
        string $street, 
        string $number, 
        string $neighborhood, 
        string $city, 
        string $state, 
        string $postalCode
    ): static {
        return $this->afterCreating(function (User $user) use (
            $street, $number, $neighborhood, $city, $state, $postalCode
        ) {
            Company::factory()
                ->withAddress($street, $number, $neighborhood, $city, $state, $postalCode)
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com uma empresa com coordenadas específicas
     */
    public function withCompanyWithCoordinates(float $latitude, float $longitude): static
    {
        return $this->afterCreating(function (User $user) use ($latitude, $longitude) {
            Company::factory()
                ->withCoordinates($latitude, $longitude)
                ->forUser($user)
                ->create();
        });
    }

    // ========================================
    // MÉTODOS COMBINADOS PARA COMPANY
    // ========================================

    /**
     * Cria um usuário com empresa de tecnologia em São Paulo
     */
    public function withTechCompanyInSaoPaulo(): static
    {
        return $this->afterCreating(function (User $user) {
            Company::factory()
                ->technology()
                ->inSaoPaulo()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com empresa comercial no Rio de Janeiro
     */
    public function withCommercialCompanyInRio(): static
    {
        return $this->afterCreating(function (User $user) {
            Company::factory()
                ->commercial()
                ->inRioDeJaneiro()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com empresa industrial em Belo Horizonte
     */
    public function withIndustrialCompanyInBH(): static
    {
        return $this->afterCreating(function (User $user) {
            Company::factory()
                ->industrial()
                ->inBeloHorizonte()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com empresa de serviços em Curitiba
     */
    public function withServicesCompanyInCuritiba(): static
    {
        return $this->afterCreating(function (User $user) {
            Company::factory()
                ->services()
                ->inCuritiba()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com empresa financeira em Brasília
     */
    public function withFinancialCompanyInBrasilia(): static
    {
        return $this->afterCreating(function (User $user) {
            Company::factory()
                ->financial()
                ->inBrasilia()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com empresa de logística em Fortaleza
     */
    public function withLogisticsCompanyInFortaleza(): static
    {
        return $this->afterCreating(function (User $user) {
            Company::factory()
                ->logistics()
                ->inFortaleza()
                ->forUser($user)
                ->create();
        });
    }

    // ========================================
    // MÉTODOS PARA COMPANY SEGMENTS (SEGMENTOS DE EMPRESA)
    // ========================================

    /**
     * Cria um usuário com segmentos de empresa padrão
     */
    public function withCompanySegments(): static
    {
        return $this->afterCreating(function (User $user) {
            // Cria segmentos padrão para o usuário
            $defaultSegments = [
                'Tecnologia',
                'Comercial',
                'Serviços',
                'Industrial'
            ];
            
            foreach ($defaultSegments as $segment) {
                CompanySegment::factory()
                    ->forUser($user)
                    ->withName($segment)
                    ->create();
            }
        });
    }

    /**
     * Cria um usuário com segmentos de empresa customizados
     */
    public function withCustomCompanySegments(array $segments): static
    {
        return $this->afterCreating(function (User $user) use ($segments) {
            foreach ($segments as $segment) {
                CompanySegment::factory()
                    ->forUser($user)
                    ->withName($segment)
                    ->create();
            }
        });
    }

    /**
     * Cria um usuário com X segmentos de empresa aleatórios
     */
    public function withRandomCompanySegments(int $count = 3): static
    {
        return $this->afterCreating(function (User $user) use ($count) {
            CompanySegment::factory()
                ->count($count)
                ->forUser($user)
                ->create();
        });
    }

    // ========================================
    // MÉTODOS COMBINADOS PARA COMPANY (EMPRESAS) - RELAÇÕES COMPLETAS
    // ========================================

    /**
     * Cria um usuário com empresa completa (com segmento e grupo)
     */
    public function withCompleteCompany(): static
    {
        return $this->afterCreating(function (User $user) {
            $segment = CompanySegment::factory()->forUser($user)->create();
            $group = CompanyGroup::factory()->forUser($user)->create();
            
            Company::factory()
                ->forUser($user)
                ->withCompanySegment($segment)
                ->withCompanyGroup($group)
                ->create();
        });
    }

    /**
     * Cria um usuário com empresa de tecnologia completa
     */
    public function withTechCompanyComplete(): static
    {
        return $this->afterCreating(function (User $user) {
            $segment = CompanySegment::factory()->technology()->forUser($user)->create();
            $group = CompanyGroup::factory()->technology()->forUser($user)->create();
            
            Company::factory()
                ->technology()
                ->forUser($user)
                ->withCompanySegment($segment)
                ->withCompanyGroup($group)
                ->create();
        });
    }

    /**
     * Cria um usuário com empresa financeira completa
     */
    public function withFinancialCompanyComplete(): static
    {
        return $this->afterCreating(function (User $user) {
            $segment = CompanySegment::factory()->financial()->forUser($user)->create();
            $group = CompanyGroup::factory()->financial()->forUser($user)->create();
            
            Company::factory()
                ->financial()
                ->forUser($user)
                ->withCompanySegment($segment)
                ->withCompanyGroup($group)
                ->create();
        });
    }

    /**
     * Cria um usuário com empresa industrial completa
     */
    public function withIndustrialCompanyComplete(): static
    {
        return $this->afterCreating(function (User $user) {
            $segment = CompanySegment::factory()->industrial()->forUser($user)->create();
            $group = CompanyGroup::factory()->industrial()->forUser($user)->create();
            
            Company::factory()
                ->industrial()
                ->forUser($user)
                ->withCompanySegment($segment)
                ->withCompanyGroup($group)
                ->create();
        });
    }

    // ========================================
    // MÉTODOS PARA RELACIONAMENTOS COMPOSTOS
    // ========================================

    /**
     * Cria um usuário com empresa, segmento e grupo do mesmo tipo
     */
    public function withCompanyAndMatchingSegmentGroup(string $type): static
    {
        return $this->afterCreating(function (User $user) use ($type) {
            $segmentMethod = lcfirst($type);
            $groupMethod = lcfirst($type);
            $companyMethod = lcfirst($type);

            $segment = CompanySegment::factory()->$segmentMethod()->forUser($user)->create();
            $group = CompanyGroup::factory()->$groupMethod()->forUser($user)->create();
            
            Company::factory()
                ->$companyMethod()
                ->forUser($user)
                ->withCompanySegment($segment)
                ->withCompanyGroup($group)
                ->create();
        });
    }

    /**
     * Cria um usuário com empresa usando segmento e grupo existentes
     */
    public function withCompanyUsingExistingSegmentAndGroup(CompanySegment $segment, CompanyGroup $group): static
    {
        return $this->afterCreating(function (User $user) use ($segment, $group) {
            Company::factory()
                ->forUser($user)
                ->withCompanySegment($segment)
                ->withCompanyGroup($group)
                ->create();
        });
    }

    // ========================================
    // MÉTODOS PARA TICKETS (NO USER FACTORY)
    // ========================================

    /**
     * Cria um usuário com tickets padrão
     */
    public function withTickets(int $count = 1): static
    {
        return $this->afterCreating(function (User $user) use ($count) {
            Ticket::factory()
                ->count($count)
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com tickets de suporte técnico
     */
    public function withTechnicalSupportTickets(int $count = 1): static
    {
        return $this->afterCreating(function (User $user) use ($count) {
            Ticket::factory()
                ->count($count)
                ->technicalSupport()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com tickets de desenvolvimento
     */
    public function withDevelopmentTickets(int $count = 1): static
    {
        return $this->afterCreating(function (User $user) use ($count) {
            Ticket::factory()
                ->count($count)
                ->development()
                ->forUser($user)
                ->create();
        });
    }

    /**
     * Cria um usuário com tickets completos (com todas as relações)
     */
    public function withFullTickets(int $count = 1): static
    {
        return $this->afterCreating(function (User $user) use ($count) {
            Ticket::factory()
                ->count($count)
                ->fullTicket()
                ->forUser($user)
                ->create();
        });
    }
}