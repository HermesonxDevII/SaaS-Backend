<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    protected $model = Role::class;
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Admin', 'Cliente', 'Funcionário']),
            'active' => true,
            'deleted' => false
        ];
    }

    /**
     * Cria uma role com nome específico
     */
    public function withName(string $name): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $name,
        ]);
    }

    /**
     * Cria uma role inativa
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'active' => false,
        ]);
    }

    /**
     * Cria uma role deletada
     */
    public function deleted(): static
    {
        return $this->state(fn (array $attributes) => [
            'deleted' => true,
        ]);
    }

    /**
     * Cria role de admin
     */
    public function admin(): static
    {
        return $this->withName('Admin');
    }

    /**
     * Cria role de cliente
     */
    public function client(): static
    {
        return $this->withName('Cliente');
    }

    /**
     * Cria role de funcionário
     */
    public function employee(): static
    {
        return $this->withName('Funcionário');
    }
}