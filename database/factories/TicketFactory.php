<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{
    Ticket,
    User,
    Company,
    Priority,
    ResponsibleTeam,
    SolicitationType
};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraphs(3, true),
            'attachments' => null,
            'active' => true,
            'deleted' => false,
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }

    /**
     * Cria um ticket para um usuário específico
     */
    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }

    /**
     * Cria um ticket para uma empresa específica
     */
    public function forCompany(Company $company): static
    {
        return $this->state(fn (array $attributes) => [
            'company_id' => $company->id,
        ]);
    }

    /**
     * Cria um ticket com um tipo de solicitação específico
     */
    public function withSolicitationType(SolicitationType $type): static
    {
        return $this->state(fn (array $attributes) => [
            'solicitation_type_id' => $type->id,
        ]);
    }

    /**
     * Cria um ticket com uma prioridade específica
     */
    public function withPriority(Priority $priority): static
    {
        return $this->state(fn (array $attributes) => [
            'priority_id' => $priority->id,
        ]);
    }

    /**
     * Cria um ticket com uma equipe responsável específica
     */
    public function withResponsibleTeam(ResponsibleTeam $team): static
    {
        return $this->state(fn (array $attributes) => [
            'responsible_team_id' => $team->id,
        ]);
    }

    /**
     * Cria um ticket inativo
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'active' => false,
        ]);
    }

    /**
     * Cria um ticket deletado
     */
    public function deleted(): static
    {
        return $this->state(fn (array $attributes) => [
            'deleted' => true,
        ]);
    }

    /**
     * Cria um ticket com anexos
     */
    public function withAttachments(array $attachments): static
    {
        return $this->state(fn (array $attributes) => [
            'attachments' => json_encode($attachments),
        ]);
    }

    // ========================================
    // MÉTODOS PARA TIPOS ESPECÍFICOS DE TICKET
    // ========================================

    /**
     * Cria um ticket de suporte técnico
     */
    public function technicalSupport(): static
    {
        return $this->afterCreating(function (Ticket $ticket) {
            if (!$ticket->solicitation_type_id) {
                $type = SolicitationType::factory()->technicalSupport()->create();
                $ticket->update(['solicitation_type_id' => $type->id]);
            }
        });
    }

    /**
     * Cria um ticket de desenvolvimento
     */
    public function development(): static
    {
        return $this->afterCreating(function (Ticket $ticket) {
            if (!$ticket->solicitation_type_id) {
                $type = SolicitationType::factory()->development()->create();
                $ticket->update(['solicitation_type_id' => $type->id]);
            }
        });
    }

    /**
     * Cria um ticket de manutenção
     */
    public function maintenance(): static
    {
        return $this->afterCreating(function (Ticket $ticket) {
            if (!$ticket->solicitation_type_id) {
                $type = SolicitationType::factory()->maintenance()->create();
                $ticket->update(['solicitation_type_id' => $type->id]);
            }
        });
    }

    // ========================================
    // MÉTODOS PARA PRIORIDADES ESPECÍFICAS
    // ========================================

    /**
     * Cria um ticket com prioridade baixa
     */
    public function lowPriority(): static
    {
        return $this->afterCreating(function (Ticket $ticket) {
            if (!$ticket->priority_id) {
                $priority = Priority::factory()->withName('Baixa')->create();
                $ticket->update(['priority_id' => $priority->id]);
            }
        });
    }

    /**
     * Cria um ticket com prioridade média
     */
    public function mediumPriority(): static
    {
        return $this->afterCreating(function (Ticket $ticket) {
            if (!$ticket->priority_id) {
                $priority = Priority::factory()->withName('Média')->create();
                $ticket->update(['priority_id' => $priority->id]);
            }
        });
    }

    /**
     * Cria um ticket com prioridade alta
     */
    public function highPriority(): static
    {
        return $this->afterCreating(function (Ticket $ticket) {
            if (!$ticket->priority_id) {
                $priority = Priority::factory()->withName('Alta')->create();
                $ticket->update(['priority_id' => $priority->id]);
            }
        });
    }

    // ========================================
    // MÉTODOS PARA EQUIPES ESPECÍFICAS
    // ========================================

    /**
     * Cria um ticket para equipe de desenvolvimento
     */
    public function developmentTeam(): static
    {
        return $this->afterCreating(function (Ticket $ticket) {
            if (!$ticket->responsible_team_id) {
                $team = ResponsibleTeam::factory()->development()->create();
                $ticket->update(['responsible_team_id' => $team->id]);
            }
        });
    }

    /**
     * Cria um ticket para equipe de suporte
     */
    public function supportTeam(): static
    {
        return $this->afterCreating(function (Ticket $ticket) {
            if (!$ticket->responsible_team_id) {
                $team = ResponsibleTeam::factory()->support()->create();
                $ticket->update(['responsible_team_id' => $team->id]);
            }
        });
    }

    /**
     * Cria um ticket para equipe de infraestrutura
     */
    public function infrastructureTeam(): static
    {
        return $this->afterCreating(function (Ticket $ticket) {
            if (!$ticket->responsible_team_id) {
                $team = ResponsibleTeam::factory()->infrastructure()->create();
                $ticket->update(['responsible_team_id' => $team->id]);
            }
        });
    }

    // ========================================
    // MÉTODOS COMBINADOS
    // ========================================

    /**
     * Cria um ticket completo com todas as relações
     */
    public function fullTicket(): static
    {
        return $this->afterCreating(function (Ticket $ticket) {
            $user = User::factory()->create();
            $company = Company::factory()->forUser($user)->create();
            $priority = Priority::factory()->forUser($user)->create();
            $team = ResponsibleTeam::factory()->forUser($user)->create();
            $type = SolicitationType::factory()->forUser($user)->create();

            $ticket->update([
                'user_id' => $user->id,
                'company_id' => $company->id,
                'priority_id' => $priority->id,
                'responsible_team_id' => $team->id,
                'solicitation_type_id' => $type->id
            ]);
        });
    }

    /**
     * Cria um ticket de suporte técnico completo
     */
    public function fullTechnicalSupport(): static
    {
        return $this->technicalSupport()
            ->mediumPriority()
            ->supportTeam()
            ->afterCreating(function (Ticket $ticket) {
                if (!$ticket->user_id) {
                    $user = User::factory()->create();
                    $ticket->update(['user_id' => $user->id]);
                }
                if (!$ticket->company_id) {
                    $company = Company::factory()->forUser($ticket->user)->create();
                    $ticket->update(['company_id' => $company->id]);
                }
            });
    }

    /**
     * Cria um ticket de desenvolvimento completo
     */
    public function fullDevelopment(): static
    {
        return $this->development()
            ->highPriority()
            ->developmentTeam()
            ->afterCreating(function (Ticket $ticket) {
                if (!$ticket->user_id) {
                    $user = User::factory()->create();
                    $ticket->update(['user_id' => $user->id]);
                }
                if (!$ticket->company_id) {
                    $company = Company::factory()->forUser($ticket->user)->create();
                    $ticket->update(['company_id' => $company->id]);
                }
            });
    }
}