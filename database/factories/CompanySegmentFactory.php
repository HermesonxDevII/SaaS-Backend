<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{ CompanySegment, User };

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanySegment>
 */
class CompanySegmentFactory extends Factory
{
    protected $model = CompanySegment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $segments = [
            'Tecnologia',
            'Alimentício',
            'Farmacêutico',
            'Automotivo',
            'Financeiro',
            'Industrial',
            'Comercial',
            'Serviços',
            'Logística',
            'Educacional',
            'Hospitalar',
            'Imobiliário',
            'Energia',
            'Telecomunicações',
            'Construção',
            'Têxtil',
            'Metalúrgico',
            'Químico',
            'Agronegócio',
            'Turismo',
            'Entretenimento',
            'Esportivo',
            'Consultoria',
            'Jurídico',
            'Contábil',
            'Seguros',
            'Transporte',
            'Mineração',
            'Petróleo e Gás',
            'Cosmético',
            'Móveis',
            'Eletrônicos',
            'Comunicação',
            'Marketing',
            'Recursos Humanos',
            'Saúde',
            'Beleza',
            'Moda',
            'Varejo',
            'Atacado',
            'E-commerce'
        ];

        return [
            'user_id' => User::factory(),
            'name' => fake()->randomElement($segments),
            'active' => fake()->boolean(90), // 90% chance de ser ativo
            'deleted' => fake()->boolean(10), // 10% chance de ser deletado
        ];
    }

    /**
     * Cria um segmento para um usuário específico
     */
    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }

    /**
     * Cria um segmento com nome específico
     */
    public function withName(string $name): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $name,
        ]);
    }

    /**
     * Cria um segmento ativo
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'active' => true,
        ]);
    }

    /**
     * Cria um segmento inativo
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'active' => false,
        ]);
    }

    /**
     * Cria um segmento deletado
     */
    public function deleted(): static
    {
        return $this->state(fn (array $attributes) => [
            'deleted' => true,
        ]);
    }

    /**
     * Cria um segmento não deletado
     */
    public function notDeleted(): static
    {
        return $this->state(fn (array $attributes) => [
            'deleted' => false,
        ]);
    }

    // ========================================
    // MÉTODOS PARA SEGMENTOS ESPECÍFICOS
    // ========================================

    /**
     * Cria um segmento de Tecnologia
     */
    public function technology(): static
    {
        return $this->withName('Tecnologia');
    }

    /**
     * Cria um segmento Alimentício
     */
    public function food(): static
    {
        return $this->withName('Alimentício');
    }

    /**
     * Cria um segmento Farmacêutico
     */
    public function pharmaceutical(): static
    {
        return $this->withName('Farmacêutico');
    }

    /**
     * Cria um segmento Automotivo
     */
    public function automotive(): static
    {
        return $this->withName('Automotivo');
    }

    /**
     * Cria um segmento Financeiro
     */
    public function financial(): static
    {
        return $this->withName('Financeiro');
    }

    /**
     * Cria um segmento Industrial
     */
    public function industrial(): static
    {
        return $this->withName('Industrial');
    }

    /**
     * Cria um segmento Comercial
     */
    public function commercial(): static
    {
        return $this->withName('Comercial');
    }

    /**
     * Cria um segmento de Serviços
     */
    public function services(): static
    {
        return $this->withName('Serviços');
    }

    /**
     * Cria um segmento de Logística
     */
    public function logistics(): static
    {
        return $this->withName('Logística');
    }

    /**
     * Cria um segmento Educacional
     */
    public function educational(): static
    {
        return $this->withName('Educacional');
    }

    /**
     * Cria um segmento Hospitalar
     */
    public function hospital(): static
    {
        return $this->withName('Hospitalar');
    }

    /**
     * Cria um segmento Imobiliário
     */
    public function realEstate(): static
    {
        return $this->withName('Imobiliário');
    }

    /**
     * Cria um segmento de Energia
     */
    public function energy(): static
    {
        return $this->withName('Energia');
    }

    /**
     * Cria um segmento de Telecomunicações
     */
    public function telecommunications(): static
    {
        return $this->withName('Telecomunicações');
    }

    /**
     * Cria um segmento de Construção
     */
    public function construction(): static
    {
        return $this->withName('Construção');
    }

    /**
     * Cria um segmento Têxtil
     */
    public function textile(): static
    {
        return $this->withName('Têxtil');
    }

    /**
     * Cria um segmento Metalúrgico
     */
    public function metallurgical(): static
    {
        return $this->withName('Metalúrgico');
    }

    /**
     * Cria um segmento Químico
     */
    public function chemical(): static
    {
        return $this->withName('Químico');
    }

    /**
     * Cria um segmento de Agronegócio
     */
    public function agribusiness(): static
    {
        return $this->withName('Agronegócio');
    }

    /**
     * Cria um segmento de Turismo
     */
    public function tourism(): static
    {
        return $this->withName('Turismo');
    }

    /**
     * Cria um segmento de Entretenimento
     */
    public function entertainment(): static
    {
        return $this->withName('Entretenimento');
    }

    /**
     * Cria um segmento Esportivo
     */
    public function sports(): static
    {
        return $this->withName('Esportivo');
    }

    /**
     * Cria um segmento de Consultoria
     */
    public function consulting(): static
    {
        return $this->withName('Consultoria');
    }

    /**
     * Cria um segmento Jurídico
     */
    public function legal(): static
    {
        return $this->withName('Jurídico');
    }

    /**
     * Cria um segmento Contábil
     */
    public function accounting(): static
    {
        return $this->withName('Contábil');
    }

    /**
     * Cria um segmento de Seguros
     */
    public function insurance(): static
    {
        return $this->withName('Seguros');
    }

    /**
     * Cria um segmento de Transporte
     */
    public function transport(): static
    {
        return $this->withName('Transporte');
    }

    /**
     * Cria um segmento de Mineração
     */
    public function mining(): static
    {
        return $this->withName('Mineração');
    }

    /**
     * Cria um segmento de Petróleo e Gás
     */
    public function oilAndGas(): static
    {
        return $this->withName('Petróleo e Gás');
    }

    /**
     * Cria um segmento Cosmético
     */
    public function cosmetic(): static
    {
        return $this->withName('Cosmético');
    }

    /**
     * Cria um segmento de Móveis
     */
    public function furniture(): static
    {
        return $this->withName('Móveis');
    }

    /**
     * Cria um segmento de Eletrônicos
     */
    public function electronics(): static
    {
        return $this->withName('Eletrônicos');
    }

    /**
     * Cria um segmento de Comunicação
     */
    public function communication(): static
    {
        return $this->withName('Comunicação');
    }

    /**
     * Cria um segmento de Marketing
     */
    public function marketing(): static
    {
        return $this->withName('Marketing');
    }

    /**
     * Cria um segmento de Recursos Humanos
     */
    public function humanResources(): static
    {
        return $this->withName('Recursos Humanos');
    }

    /**
     * Cria um segmento de Saúde
     */
    public function health(): static
    {
        return $this->withName('Saúde');
    }

    /**
     * Cria um segmento de Beleza
     */
    public function beauty(): static
    {
        return $this->withName('Beleza');
    }

    /**
     * Cria um segmento de Moda
     */
    public function fashion(): static
    {
        return $this->withName('Moda');
    }

    /**
     * Cria um segmento de Varejo
     */
    public function retail(): static
    {
        return $this->withName('Varejo');
    }

    /**
     * Cria um segmento de Atacado
     */
    public function wholesale(): static
    {
        return $this->withName('Atacado');
    }

    /**
     * Cria um segmento de E-commerce
     */
    public function ecommerce(): static
    {
        return $this->withName('E-commerce');
    }
}