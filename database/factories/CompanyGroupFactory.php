<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{ User, CompanyGroup};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyGroup>
 */
class CompanyGroupFactory extends Factory
{
    protected $model = CompanyGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->randomElement([
                'Grupo Empresarial Norte',
                'Grupo Empresarial Sul',
                'Grupo Empresarial Leste',
                'Grupo Empresarial Oeste',
                'Grupo Empresarial Central',
                'Grupo Tecnologia',
                'Grupo Financeiro',
                'Grupo Industrial',
                'Grupo Comercial',
                'Grupo Serviços',
                'Grupo Logística',
                'Grupo Alimentício',
                'Grupo Farmacêutico',
                'Grupo Educacional',
                'Grupo Hospitalar',
                'Grupo Imobiliário',
                'Grupo Automotivo',
                'Grupo Energia',
                'Grupo Telecomunicações',
                'Grupo Construção'
            ]),
            'active' => true,
            'deleted' => false,
        ];
    }

    /**
     * Cria um CompanyGroup para um usuário específico
     */
    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }

    /**
     * Cria um CompanyGroup para um ID de usuário específico
     */
    public function forUserId(int $userId): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $userId,
        ]);
    }

    /**
     * Cria um CompanyGroup com nome específico
     */
    public function withName(string $name): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $name,
        ]);
    }

    /**
     * Cria um CompanyGroup inativo
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'active' => false,
        ]);
    }

    /**
     * Cria um CompanyGroup deletado
     */
    public function deleted(): static
    {
        return $this->state(fn (array $attributes) => [
            'deleted' => true,
        ]);
    }

    /**
     * Cria um CompanyGroup do tipo tecnologia
     */
    public function technology(): static
    {
        return $this->withName('Grupo Tecnologia');
    }

    /**
     * Cria um CompanyGroup do tipo financeiro
     */
    public function financial(): static
    {
        return $this->withName('Grupo Financeiro');
    }

    /**
     * Cria um CompanyGroup do tipo industrial
     */
    public function industrial(): static
    {
        return $this->withName('Grupo Industrial');
    }

    /**
     * Cria um CompanyGroup do tipo comercial
     */
    public function commercial(): static
    {
        return $this->withName('Grupo Comercial');
    }

    /**
     * Cria um CompanyGroup do tipo serviços
     */
    public function services(): static
    {
        return $this->withName('Grupo Serviços');
    }

    /**
     * Cria um CompanyGroup do tipo logística
     */
    public function logistics(): static
    {
        return $this->withName('Grupo Logística');
    }

    /**
     * Cria um CompanyGroup do tipo alimentício
     */
    public function food(): static
    {
        return $this->withName('Grupo Alimentício');
    }

    /**
     * Cria um CompanyGroup do tipo farmacêutico
     */
    public function pharmaceutical(): static
    {
        return $this->withName('Grupo Farmacêutico');
    }

    /**
     * Cria um CompanyGroup do tipo educacional
     */
    public function educational(): static
    {
        return $this->withName('Grupo Educacional');
    }

    /**
     * Cria um CompanyGroup do tipo hospitalar
     */
    public function hospital(): static
    {
        return $this->withName('Grupo Hospitalar');
    }

    /**
     * Cria um CompanyGroup do tipo imobiliário
     */
    public function realEstate(): static
    {
        return $this->withName('Grupo Imobiliário');
    }

    /**
     * Cria um CompanyGroup do tipo automotivo
     */
    public function automotive(): static
    {
        return $this->withName('Grupo Automotivo');
    }

    /**
     * Cria um CompanyGroup do tipo energia
     */
    public function energy(): static
    {
        return $this->withName('Grupo Energia');
    }

    /**
     * Cria um CompanyGroup do tipo telecomunicações
     */
    public function telecommunications(): static
    {
        return $this->withName('Grupo Telecomunicações');
    }

    /**
     * Cria um CompanyGroup do tipo construção
     */
    public function construction(): static
    {
        return $this->withName('Grupo Construção');
    }
}