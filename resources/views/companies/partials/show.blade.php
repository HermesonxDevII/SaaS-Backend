<div class="flex flex-col">
    <x-input-box>
        <x-input-with-label
            label="Razão Social"
            name="corporate_reason"
            :value="$company->corporate_reason"
            :readonly=true
        />
        
        <x-input-with-label
            label="Nome Fantasia"
            name="fantasy_name"
            :value="$company->fantasy_name"
            :readonly=true
        />
        
        <x-input-with-label
            label="CPF/CNPJ"
            name="cpf_cnpj"
            :value="$company->cpf_cnpj"
            :readonly=true
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="Segmento"
            name="company_segment"
            :value="$company->companySegment->name"
            :readonly=true
        />
        
        <x-input-with-label
            label="Grupo"
            name="company_group"
            :value="$company->companyGroup->name"
            :readonly=true
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="Rua"
            name="street"
            :value="$company->street"
            :readonly=true
        />
        
        <x-input-with-label
            label="Número"
            name="number"
            :value="$company->number"
            :readonly=true
        />
        
        <x-input-with-label
            label="Bairro"
            name="neighborhood"
            :value="$company->neighborhood"
            :readonly=true
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="CEP"
            name="postal_code"
            :value="$company->postal_code"
            :readonly=true
        />

        <x-input-with-label
            label="Cidade"
            name="city"
            :value="$company->city"
            :readonly=true
        />
        
        <x-input-with-label
            label="Estado"
            name="state"
            :value="$company->state"
            :readonly=true
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="Latitude"
            name="latitude"
            :value="$company->latitude"
            :readonly=true
        />
        
        <x-input-with-label
            label="Longitude"
            name="longitude"
            :value="$company->longitude"
            :readonly=true
        />

        <x-input-with-label
            label="Status"
            name="status"
            value="{{ $company->active === 1 ? 'Ativo' : 'Inativo' }}"
            :readonly=true
        />
    </x-input-box>
</div>