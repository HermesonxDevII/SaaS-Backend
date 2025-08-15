<div class="flex flex-col">
    <x-input-box>
        <x-input-with-label
            label="Razão Social"
            for="corporate_reason"
            name="corporate_reason"
            :value="$company->corporate_reason"
            readonly
        />
        
        <x-input-with-label
            label="Nome Fantasia"
            for="fantasy_name"
            name="fantasy_name"
            :value="$company->fantasy_name"
            readonly
        />
        
        <x-input-with-label
            label="CPF/CNPJ"
            for="cpf_cnpj"
            name="cpf_cnpj"
            :value="$company->cpf_cnpj"
            readonly
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="Segmento"
            for="company_segment"
            name="company_segment"
            :value="$company->companySegment->name"
            readonly
        />
        
        <x-input-with-label
            label="Grupo"
            for="company_group"
            name="company_group"
            :value="$company->companyGroup->name"
            readonly
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="Rua"
            for="street"
            name="street"
            :value="$company->street"
            readonly
        />
        
        <x-input-with-label
            label="Número"
            for="number"
            name="number"
            :value="$company->number"
            readonly
        />
        
        <x-input-with-label
            label="Bairro"
            for="neighborhood"
            name="neighborhood"
            :value="$company->neighborhood"
            readonly
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="CEP"
            for="postal_code"
            name="postal_code"
            maxlength="9"
            :value="$company->postal_code"
            readonly
        />

        <x-input-with-label
            label="Cidade"
            for="city"
            name="city"
            :value="$company->city"
            readonly
        />
        
        <x-input-with-label
            label="Estado"
            for="state"
            name="state"
            :value="$company->state"
            readonly
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="Latitude"
            for="latitude"
            name="latitude"
            :value="$company->latitude"
            readonly
        />
        
        <x-input-with-label
            label="Longitude"
            for="longitude"
            name="longitude"
            :value="$company->longitude"
            readonly
        />

        <x-input-with-label
            label="Status"
            for="status"
            name="status"
            value="{{ $company->active === 1 ? 'Ativo' : 'Inativo' }}"
            readonly
        />
    </x-input-box>
</div>