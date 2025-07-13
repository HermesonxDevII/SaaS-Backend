<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{ User, SolicitationType };

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SolicitationType>
 */
class SolicitationTypeFactory extends Factory
{
    protected $model = SolicitationType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->randomElement([
                'Suporte Técnico',
                'Solicitação de Acesso',
                'Manutenção',
                'Desenvolvimento',
                'Consultoria',
                'Treinamento',
                'Infraestrutura',
                'Segurança',
                'Backup',
                'Atualização de Sistema'
            ]),
            'active' => true,
            'deleted' => false,
        ];
    }

    /**
     * Cria um SolicitationType para um usuário específico
     */
    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }

    /**
     * Cria um SolicitationType para um ID de usuário específico
     */
    public function forUserId(int $userId): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $userId,
        ]);
    }

    /**
     * Cria um SolicitationType com nome específico
     */
    public function withName(string $name): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $name,
        ]);
    }

    /**
     * Cria um SolicitationType inativo
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'active' => false,
        ]);
    }

    /**
     * Cria um SolicitationType deletado
     */
    public function deleted(): static
    {
        return $this->state(fn (array $attributes) => [
            'deleted' => true,
        ]);
    }

    /**
     * Cria um SolicitationType para suporte técnico
     */
    public function technicalSupport(): static
    {
        return $this->withName('Suporte Técnico');
    }

    /**
     * Cria um SolicitationType para desenvolvimento
     */
    public function development(): static
    {
        return $this->withName('Desenvolvimento');
    }

    /**
     * Cria um SolicitationType para manutenção
     */
    public function maintenance(): static
    {
        return $this->withName('Manutenção');
    }

    /**
     * Cria um SolicitationType para consultoria
     */
    public function consulting(): static
    {
        return $this->withName('Consultoria');
    }

    /**
     * Cria um SolicitationType para infraestrutura
     */
    public function infrastructure(): static
    {
        return $this->withName('Infraestrutura');
    }

    /**
     * Cria um SolicitationType para segurança
     */
    public function security(): static
    {
        return $this->withName('Segurança');
    }
}