<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{
    Company,
    User,
    CompanyGroup,
    CompanySegment
};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'corporate_reason' => fake()->company() . ' LTDA',
            'fantasy_name' => fake()->company(),
            'cpf_cnpj' => fake()->numerify('##.###.###/####-##'),
            'street' => fake()->streetName(),
            'number' => fake()->buildingNumber(),
            'neighborhood' => fake()->streetSuffix(),
            'city' => fake()->city(),
            'state' => fake()->stateAbbr(),
            'postal_code' => fake()->postcode(),
            'company_segment_id' => CompanySegment::factory(),
            'company_group_id' => CompanyGroup::factory(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'active' => true,
            'deleted' => false
        ];
    }

    /**
     * Cria uma empresa para um usuário específico
     */
    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }

    /**
     * Cria uma empresa com razão social específica
     */
    public function withCorporateReason(string $corporateReason): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => $corporateReason,
        ]);
    }

    /**
     * Cria uma empresa com nome fantasia específico
     */
    public function withFantasyName(string $fantasyName): static
    {
        return $this->state(fn (array $attributes) => [
            'fantasy_name' => $fantasyName,
        ]);
    }

    /**
     * Cria uma empresa com CPF/CNPJ específico
     */
    public function withCpfCnpj(string $cpfCnpj): static
    {
        return $this->state(fn (array $attributes) => [
            'cpf_cnpj' => $cpfCnpj,
        ]);
    }

    /**
     * Cria uma empresa com endereço específico
     */
    public function withAddress(string $street, string $number, string $neighborhood, string $city, string $state, string $postalCode): static
    {
        return $this->state(fn (array $attributes) => [
            'street' => $street,
            'number' => $number,
            'neighborhood' => $neighborhood,
            'city' => $city,
            'state' => $state,
            'postal_code' => $postalCode,
        ]);
    }

    /**
     * Cria uma empresa com coordenadas específicas
     */
    public function withCoordinates(float $latitude, float $longitude): static
    {
        return $this->state(fn (array $attributes) => [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }

    /**
     * Cria uma empresa com segmento específico
     */
    public function withCompanySegment(CompanySegment $segment): static
    {
        return $this->state(fn (array $attributes) => [
            'company_segment_id' => $segment->id,
        ]);
    }

    /**
     * Cria uma empresa com grupo específico
     */
    public function withCompanyGroup(CompanyGroup $group): static
    {
        return $this->state(fn (array $attributes) => [
            'company_group_id' => $group->id,
        ]);
    }

    /**
     * Cria uma empresa inativa
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'active' => false,
        ]);
    }

    /**
     * Cria uma empresa excluída
     */
    public function deleted(): static
    {
        return $this->state(fn (array $attributes) => [
            'deleted' => true,
        ]);
    }

    // ========================================
    // MÉTODOS PARA TIPOS DE EMPRESA
    // ========================================

    /**
     * Cria uma empresa de tecnologia
     */
    public function technology(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Tecnologia LTDA',
            'fantasy_name' => fake()->company() . ' Tech',
        ]);
    }

    /**
     * Cria uma empresa comercial
     */
    public function commercial(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Comércio LTDA',
            'fantasy_name' => fake()->company() . ' Store',
        ]);
    }

    /**
     * Cria uma empresa industrial
     */
    public function industrial(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Indústria LTDA',
            'fantasy_name' => fake()->company() . ' Industrial',
        ]);
    }

    /**
     * Cria uma empresa de serviços
     */
    public function services(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Serviços LTDA',
            'fantasy_name' => fake()->company() . ' Services',
        ]);
    }

    /**
     * Cria uma empresa financeira
     */
    public function financial(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Financeira LTDA',
            'fantasy_name' => fake()->company() . ' Finance',
        ]);
    }

    /**
     * Cria uma empresa de logística
     */
    public function logistics(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Logística LTDA',
            'fantasy_name' => fake()->company() . ' Logistics',
        ]);
    }

    /**
     * Cria uma empresa alimentícia
     */
    public function food(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Alimentos LTDA',
            'fantasy_name' => fake()->company() . ' Food',
        ]);
    }

    /**
     * Cria uma empresa farmacêutica
     */
    public function pharmaceutical(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Farmacêutica LTDA',
            'fantasy_name' => fake()->company() . ' Pharma',
        ]);
    }

    /**
     * Cria uma empresa educacional
     */
    public function educational(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Educação LTDA',
            'fantasy_name' => fake()->company() . ' Education',
        ]);
    }

    /**
     * Cria uma empresa hospitalar
     */
    public function hospital(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Hospital LTDA',
            'fantasy_name' => 'Hospital ' . fake()->company(),
        ]);
    }

    /**
     * Cria uma empresa imobiliária
     */
    public function realEstate(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Imobiliária LTDA',
            'fantasy_name' => fake()->company() . ' Imóveis',
        ]);
    }

    /**
     * Cria uma empresa automotiva
     */
    public function automotive(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Automotiva LTDA',
            'fantasy_name' => fake()->company() . ' Auto',
        ]);
    }

    /**
     * Cria uma empresa de energia
     */
    public function energy(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Energia LTDA',
            'fantasy_name' => fake()->company() . ' Energy',
        ]);
    }

    /**
     * Cria uma empresa de telecomunicações
     */
    public function telecommunications(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Telecomunicações LTDA',
            'fantasy_name' => fake()->company() . ' Telecom',
        ]);
    }

    /**
     * Cria uma empresa de construção
     */
    public function construction(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Construção LTDA',
            'fantasy_name' => fake()->company() . ' Construções',
        ]);
    }

    /**
     * Cria uma empresa têxtil
     */
    public function textile(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Têxtil LTDA',
            'fantasy_name' => fake()->company() . ' Textil',
        ]);
    }

    /**
     * Cria uma empresa metalúrgica
     */
    public function metallurgical(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Metalúrgica LTDA',
            'fantasy_name' => fake()->company() . ' Metal',
        ]);
    }

    /**
     * Cria uma empresa química
     */
    public function chemical(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Química LTDA',
            'fantasy_name' => fake()->company() . ' Chemical',
        ]);
    }

    /**
     * Cria uma empresa de agronegócio
     */
    public function agribusiness(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Agronegócio LTDA',
            'fantasy_name' => fake()->company() . ' Agro',
        ]);
    }

    /**
     * Cria uma empresa de turismo
     */
    public function tourism(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Turismo LTDA',
            'fantasy_name' => fake()->company() . ' Tourism',
        ]);
    }

    /**
     * Cria uma empresa de entretenimento
     */
    public function entertainment(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Entretenimento LTDA',
            'fantasy_name' => fake()->company() . ' Entertainment',
        ]);
    }

    /**
     * Cria uma empresa esportiva
     */
    public function sports(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Esportes LTDA',
            'fantasy_name' => fake()->company() . ' Sports',
        ]);
    }

    /**
     * Cria uma empresa de consultoria
     */
    public function consulting(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Consultoria LTDA',
            'fantasy_name' => fake()->company() . ' Consulting',
        ]);
    }

    /**
     * Cria uma empresa jurídica
     */
    public function legal(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Advocacia LTDA',
            'fantasy_name' => 'Escritório ' . fake()->company(),
        ]);
    }

    /**
     * Cria uma empresa contábil
     */
    public function accounting(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Contabilidade LTDA',
            'fantasy_name' => fake()->company() . ' Contábil',
        ]);
    }

    /**
     * Cria uma empresa de seguros
     */
    public function insurance(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Seguros LTDA',
            'fantasy_name' => fake()->company() . ' Seguros',
        ]);
    }

    /**
     * Cria uma empresa de transporte
     */
    public function transport(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Transportes LTDA',
            'fantasy_name' => fake()->company() . ' Transportes',
        ]);
    }

    /**
     * Cria uma empresa de mineração
     */
    public function mining(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Mineração LTDA',
            'fantasy_name' => fake()->company() . ' Mining',
        ]);
    }

    /**
     * Cria uma empresa de petróleo e gás
     */
    public function oilAndGas(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Petróleo e Gás LTDA',
            'fantasy_name' => fake()->company() . ' Oil & Gas',
        ]);
    }

    /**
     * Cria uma empresa cosmética
     */
    public function cosmetic(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Cosméticos LTDA',
            'fantasy_name' => fake()->company() . ' Beauty',
        ]);
    }

    /**
     * Cria uma empresa de móveis
     */
    public function furniture(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Móveis LTDA',
            'fantasy_name' => fake()->company() . ' Móveis',
        ]);
    }

    /**
     * Cria uma empresa de eletrônicos
     */
    public function electronics(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Eletrônicos LTDA',
            'fantasy_name' => fake()->company() . ' Electronics',
        ]);
    }

    /**
     * Cria uma empresa de comunicação
     */
    public function communication(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Comunicação LTDA',
            'fantasy_name' => fake()->company() . ' Comunicação',
        ]);
    }

    /**
     * Cria uma empresa de marketing
     */
    public function marketing(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Marketing LTDA',
            'fantasy_name' => fake()->company() . ' Marketing',
        ]);
    }

    /**
     * Cria uma empresa de recursos humanos
     */
    public function humanResources(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Recursos Humanos LTDA',
            'fantasy_name' => fake()->company() . ' RH',
        ]);
    }

    /**
     * Cria uma empresa de saúde
     */
    public function health(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Saúde LTDA',
            'fantasy_name' => fake()->company() . ' Health',
        ]);
    }

    /**
     * Cria uma empresa de beleza
     */
    public function beauty(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Beleza LTDA',
            'fantasy_name' => fake()->company() . ' Beauty',
        ]);
    }

    /**
     * Cria uma empresa de moda
     */
    public function fashion(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Moda LTDA',
            'fantasy_name' => fake()->company() . ' Fashion',
        ]);
    }

    /**
     * Cria uma empresa de varejo
     */
    public function retail(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Varejo LTDA',
            'fantasy_name' => fake()->company() . ' Retail',
        ]);
    }

    /**
     * Cria uma empresa de atacado
     */
    public function wholesale(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' Atacado LTDA',
            'fantasy_name' => fake()->company() . ' Wholesale',
        ]);
    }

    /**
     * Cria uma empresa de e-commerce
     */
    public function ecommerce(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' E-commerce LTDA',
            'fantasy_name' => fake()->company() . ' Online',
        ]);
    }

    // ========================================
    // MÉTODOS PARA LOCALIZAÇÕES ESPECÍFICAS
    // ========================================

    /**
     * Cria uma empresa em São Paulo
     */
    public function inSaoPaulo(): static
    {
        return $this->state(fn (array $attributes) => [
            'city' => 'São Paulo',
            'state' => 'SP',
            'postal_code' => fake()->regexify('[0-9]{5}-[0-9]{3}'),
        ]);
    }

    /**
     * Cria uma empresa no Rio de Janeiro
     */
    public function inRioDeJaneiro(): static
    {
        return $this->state(fn (array $attributes) => [
            'city' => 'Rio de Janeiro',
            'state' => 'RJ',
            'postal_code' => fake()->regexify('[0-9]{5}-[0-9]{3}'),
        ]);
    }

    /**
     * Cria uma empresa em Fortaleza
     */
    public function inFortaleza(): static
    {
        return $this->state(fn (array $attributes) => [
            'city' => 'Fortaleza',
            'state' => 'CE',
            'postal_code' => fake()->regexify('[0-9]{5}-[0-9]{3}'),
        ]);
    }

    /**
     * Cria uma empresa em Belo Horizonte
     */
    public function inBeloHorizonte(): static
    {
        return $this->state(fn (array $attributes) => [
            'city' => 'Belo Horizonte',
            'state' => 'MG',
            'postal_code' => fake()->regexify('[0-9]{5}-[0-9]{3}'),
        ]);
    }

    /**
     * Cria uma empresa em Brasília
     */
    public function inBrasilia(): static
    {
        return $this->state(fn (array $attributes) => [
            'city' => 'Brasília',
            'state' => 'DF',
            'postal_code' => fake()->regexify('[0-9]{5}-[0-9]{3}'),
        ]);
    }

    /**
     * Cria uma empresa em Salvador
     */
    public function inSalvador(): static
    {
        return $this->state(fn (array $attributes) => [
            'city' => 'Salvador',
            'state' => 'BA',
            'postal_code' => fake()->regexify('[0-9]{5}-[0-9]{3}'),
        ]);
    }

    /**
     * Cria uma empresa em Recife
     */
    public function inRecife(): static
    {
        return $this->state(fn (array $attributes) => [
            'city' => 'Recife',
            'state' => 'PE',
            'postal_code' => fake()->regexify('[0-9]{5}-[0-9]{3}'),
        ]);
    }

    /**
     * Cria uma empresa em Curitiba
     */
    public function inCuritiba(): static
    {
        return $this->state(fn (array $attributes) => [
            'city' => 'Curitiba',
            'state' => 'PR',
            'postal_code' => fake()->regexify('[0-9]{5}-[0-9]{3}'),
        ]);
    }

    /**
     * Cria uma empresa em Porto Alegre
     */
    public function inPortoAlegre(): static
    {
        return $this->state(fn (array $attributes) => [
            'city' => 'Porto Alegre',
            'state' => 'RS',
            'postal_code' => fake()->regexify('[0-9]{5}-[0-9]{3}'),
        ]);
    }

    /**
     * Cria uma empresa em Manaus
     */
    public function inManaus(): static
    {
        return $this->state(fn (array $attributes) => [
            'city' => 'Manaus',
            'state' => 'AM',
            'postal_code' => fake()->regexify('[0-9]{5}-[0-9]{3}'),
        ]);
    }

    // ========================================
    // MÉTODOS PARA TAMANHOS DE EMPRESA
    // ========================================

    /**
     * Cria uma microempresa
     */
    public function microCompany(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' ME',
            'fantasy_name' => fake()->company(),
        ]);
    }

    /**
     * Cria uma empresa de pequeno porte
     */
    public function smallCompany(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' EPP',
            'fantasy_name' => fake()->company(),
        ]);
    }

    /**
     * Cria uma sociedade anônima
     */
    public function corporation(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' S.A.',
            'fantasy_name' => fake()->company(),
        ]);
    }

    /**
     * Cria uma empresa limitada
     */
    public function limitedCompany(): static
    {
        return $this->state(fn (array $attributes) => [
            'corporate_reason' => fake()->company() . ' LTDA',
            'fantasy_name' => fake()->company(),
        ]);
    }
}