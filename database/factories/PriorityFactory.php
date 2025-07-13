<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{ User, Priority };

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Priority>
 */
class PriorityFactory extends Factory
{
    protected $model = Priority::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->randomElement(['Baixa', 'Média', 'Alta', 'Urgente', 'Crítica']),
            'active' => true,
            'deleted' => false
        ];
    }

    /**
     * Cria uma prioridade para um usuário específico
     */
    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }

    /**
     * Cria uma prioridade com nome específico
     */
    public function withName(string $name): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $name,
        ]);
    }

    /**
     * Cria uma prioridade inativa
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'active' => false,
        ]);
    }

    /**
     * Cria uma prioridade deletada
     */
    public function deleted(): static
    {
        return $this->state(fn (array $attributes) => [
            'deleted' => true,
        ]);
    }
}