<x-alerts />

<form
    action="{{ route('companies.store') }}"
    method="POST"
    class="flex flex-col"
>
    @csrf
    <x-input-box>
        <x-input-with-label
            label="Razão Social *"
            name="corporate_reason"
            placeholder="Digite a Razão Social"
            required
        />
        
        <x-input-with-label
            label="Nome Fantasia *"
            name="fantasy_name"
            placeholder="Digite o Nome Fantasia"
            required
        />
        
        <x-input-with-label
            label="CPF/CNPJ *"
            name="cpf_cnpj"
            maxlength="18"
            placeholder="Digite o CPF/CNPJ"
            required
        />
    </x-input-box>

    <x-input-box>
        <x-select-with-label
            label="Segmento *"
            name="company_segment"
            :options="$companies_segments"
            placeholder="Selecione um Segmento"
            required
        />
        
        <x-select-with-label
            label="Grupo"
            name="company_group"
            :options="$companies_groups"
            placeholder="Selecione um Grupo"
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="Rua"
            name="street"
            placeholder="Digite a Rua"
        />
        
        <x-input-with-label
            label="Número"
            name="number"
            placeholder="Digite o Número"
        />
        
        <x-input-with-label
            label="Bairro"
            name="neighborhood"
            placeholder="Digite o Bairro"
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="CEP"
            name="postal_code"
            maxlength="9"
            placeholder="Digite o CEP"
        />

        <x-input-with-label
            label="Cidade"
            name="city"
            placeholder="Digite a Cidade"
        />
        
        <x-input-with-label
            label="Estado"
            name="state"
            placeholder="Digite o Estado (UF)"
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="Latitude"
            name="latitude"
            placeholder="Digite a Latitude"
        />
        
        <x-input-with-label
            label="Longitude"
            name="longitude"
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