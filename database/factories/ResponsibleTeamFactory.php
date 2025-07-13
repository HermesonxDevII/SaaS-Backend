<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{ User, ResponsibleTeam };

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ResponsibleTeam>
 */
class ResponsibleTeamFactory extends Factory
{
    protected $model = ResponsibleTeam::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->randomElement([
                'Equipe de Desenvolvimento',
                'Equipe de Suporte',
                'Equipe de Infraestrutura',
                'Equipe de QA',
                'Equipe de DevOps',
                'Equipe de Frontend',
                'Equipe de Backend',
                'Equipe de Mobile',
                'Equipe de Design',
                'Equipe de Produto'
            ]),
            'active' => true,
            'deleted' => false
        ];
    }

    /**
     * Cria um responsible team para um usuário específico
     */
    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }

    /**
     * Cria um responsible team com nome específico
     */
    public function withName(string $name): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $name,
        ]);
    }

    /**
     * Cria um responsible team inativo
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'active' => false,
        ]);
    }

    /**
     * Cria um responsible team deletado
     */
    public function deleted(): static
    {
        return $this->state(fn (array $attributes) => [
            'deleted' => true,
        ]);
    }

    /**
     * Cria equipe de desenvolvimento
     */
    public function development(): static
    {
        return $this->withName('Equipe de Desenvolvimento');
    }

    /**
     * Cria equipe de suporte
     */
    public function support(): static
    {
        return $this->withName('Equipe de Suporte');
    }

    /**
     * Cria equipe de infraestrutura
     */
    public function infrastructure(): static
    {
        return $this->withName('Equipe de Infraestrutura');
    }

    /**
     * Cria equipe de QA
     */
    public function qa(): static
    {
        return $this->withName('Equipe de QA');
    }

    /**
     * Cria equipe de DevOps
     */
    public function devops(): static
    {
        return $this->withName('Equipe de DevOps');
    }
}