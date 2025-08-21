<x-alerts />

<form
    action="{{ route('companies.update', $company->id) }}"
    method="POST"
    class="flex flex-col"
>
    @method('PUT')
    @csrf
    <div class="mb-5">
        <x-toggle
            name="active"
            label="Ativo"
            :checked="$company->active"
        />
    </div>

    <x-input-box>
        <x-input-with-label
            label="Razão Social"
            name="corporate_reason"
            :value="$company->corporate_reason"
            placeholder="Digite a Razão Social"
        />
        
        <x-input-with-label
            label="Nome Fantasia"
            name="fantasy_name"
            :value="$company->fantasy_name"
            placeholder="Digite o Nome Fantasia"
        />
        
        <x-input-with-label
            label="CPF/CNPJ"
            name="cpf_cnpj"
            :value="$company->cpf_cnpj"
            maxlength="18"
            placeholder="Digite o CPF/CNPJ"
        />
    </x-input-box>

    <x-input-box>
        <x-select-with-label
            label="Segmento"
            name="company_segment"
            :value="$company->companySegment->id"
            :options="$companies_segments"
            placeholder="Selecione um Segmento"
        />
        
        <x-select-with-label
            label="Grupo"
            name="company_group"
            :value="$company->companyGroup?->id"
            :options="$companies_groups"
            placeholder="Selecione um Grupo"
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="Rua"
            name="street"
            :value="$company->street"
            placeholder="Digite a Rua"
        />
        
        <x-input-with-label
            label="Número"
            name="number"
            :value="$company->number"
            placeholder="Digite o Número"
        />
        
        <x-input-with-label
            label="Bairro"
            name="neighborhood"
            :value="$company->neighborhood"
            placeholder="Digite o Bairro"
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="CEP"
            name="postal_code"
            :value="$company->postal_code"
            maxlength="9"
            placeholder="Digite o CEP"
        />

        <x-input-with-label
            label="Cidade"
            name="city"
            :value="$company->city"
            placeholder="Digite a Cidade"
        />
        
        <x-input-with-label
            label="Estado"
            name="state"
            :value="$company->state"
            placeholder="Digite o Estado (UF)"
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="Latitude"
            name="latitude"
            :value="$company->latitude"
            placeholder="Digite a Latitude"
        />
        
        <x-input-with-label
            label="Longitude"
            name="longitude"
            :value="$company->longitude"
            placeholder="Digite a Longitude"
        />
    </x-input-box>

    <div class="w-full flex flex-row justify-end gap-2">
        <x-button type="submit">Salvar</x-button>
        <x-link-button
            link="{{ route('companies.index') }}"
            warning
        > Cancelar </x-link-button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputCpfCnpj = document.querySelector('[name="cpf_cnpj"]');
        inputCpfCnpj.addEventListener('input', formatCpfCnpj);

        const inputPostalCode = document.querySelector('[name="postal_code"]');
        inputPostalCode.addEventListener('input', formatPostalCode);
    });

    function formatCpfCnpj(event) {
        const input = event.target;
        
        let valor = input.value.replace(/\D/g, '');

        if (valor.length <= 11) {
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        } else {
            valor = valor.replace(/^(\d{2})(\d)/, '$1.$2');
            valor = valor.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
            valor = valor.replace(/\.(\d{3})(\d)/, '.$1/$2');
            valor = valor.replace(/(\d{4})(\d)/, '$1-$2');
        }

        input.value = valor;
    }

    function formatPostalCode(event) {
        const input = event.target;

        let valor = input.value.replace(/\D/g, '');
        
        valor = valor.replace(/(\d{5})(\d)/, '$1-$2'); 
        
        input.value = valor;
    }
</script>