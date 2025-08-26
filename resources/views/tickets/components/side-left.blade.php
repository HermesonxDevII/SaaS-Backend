@props([
    'company'
])

<div class="w-[25%] p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <h2 class="ml-0.5 mb-3 font-bold">Dados do Cliente</h2>

    <x-input-with-label
        label="Razão Social"
        name="corporate_reason"
        :value="$company->corporate_reason"
        readonly
    />
    
    <x-input-with-label
        label="Nome Fantasia"
        name="fantasy_name"
        :value="$company->fantasy_name"
        readonly
    />
    
    <x-input-with-label
        label="CPF/CNPJ"
        name="cpf_cnpj"
        :value="$company->cpf_cnpj"
        readonly
    />

    <x-input-with-label
        label="Segmento"
        name="company_segment"
        :value="$company->companySegment?->name ?? 'Sem Segmento'"
        readonly
    />
    
    <x-input-with-label
        label="Grupo"
        name="company_group"
        :value="$company->companyGroup?->name ?? 'Sem Grupo'"
        readonly
    />

    <x-textarea-with-label
        label="Endereço"
        name="address"
        :value="$company->address"
    />

    <x-input-with-label
        label="Latitude"
        name="latitude"
        :value="$company->latitude"
        readonly
    />
    
    <x-input-with-label
        label="Longitude"
        name="longitude"
        :value="$company->longitude"
        readonly
    />
</div>