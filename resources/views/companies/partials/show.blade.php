<div class="flex flex-col">
    <x-input-box>
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
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="Segmento"
            name="company_segment"
            :value="$company->companySegment->name"
            readonly
        />
        
        <x-input-with-label
            label="Grupo"
            name="company_group"
            :value="$company->companyGroup->name"
            readonly
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="Rua"
            name="street"
            :value="$company->street"
            readonly
        />
        
        <x-input-with-label
            label="Número"
            name="number"
            :value="$company->number"
            readonly
        />
        
        <x-input-with-label
            label="Bairro"
            name="neighborhood"
            :value="$company->neighborhood"
            readonly
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="CEP"
            name="postal_code"
            maxlength="9"
            :value="$company->postal_code"
            readonly
        />

        <x-input-with-label
            label="Cidade"
            name="city"
            :value="$company->city"
            readonly
        />
        
        <x-input-with-label
            label="Estado"
            name="state"
            :value="$company->state"
            readonly
        />
    </x-input-box>

    <x-input-box>
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

        <x-input-with-label
            label="Status"
            name="status"
            value="{{ $company->active ? 'Ativo' : 'Inativo' }}"
            readonly
        />
    </x-input-box>
</div>