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
            for="corporate_reason"
            name="corporate_reason"
            placeholder="Digite a Razão Social"
            required
        />
        
        <x-input-with-label
            label="Nome Fantasia *"
            for="fantasy_name"
            name="fantasy_name"
            placeholder="Digite o Nome Fantasia"
            required
        />
        
        <x-input-with-label
            label="CPF/CNPJ *"
            for="cpf_cnpj"
            name="cpf_cnpj"
            maxlength="18"
            placeholder="Digite o CPF/CNPJ"
            required
        />
    </x-input-box>

    <x-input-box>
        <x-select-with-label
            label="Segmento *"
            for="company_segment"
            name="company_segment"
            :options="$companies_segments"
            placeholder="Selecione um Segmento"
            required
        />
        
        <x-select-with-label
            label="Grupo *"
            for="company_group"
            name="company_group"
            :options="$companies_groupies"
            placeholder="Selecione um Grupo"
            required
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="Rua"
            for="street"
            name="street"
            placeholder="Digite a Rua"
        />
        
        <x-input-with-label
            label="Número"
            for="number"
            name="number"
            placeholder="Digite o Número"
        />
        
        <x-input-with-label
            label="Bairro"
            for="neighborhood"
            name="neighborhood"
            placeholder="Digite o Bairro"
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="CEP"
            for="postal_code"
            name="postal_code"
            maxlength="9"
            placeholder="Digite o CEP"
        />

        <x-input-with-label
            label="Cidade"
            for="city"
            name="city"
            placeholder="Digite a Cidade"
        />
        
        <x-input-with-label
            label="Estado"
            for="state"
            name="state"
            placeholder="Digite o Estado (UF)"
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="Latitude"
            for="latitude"
            name="latitude"
            placeholder="Digite a Latitude"
        />
        
        <x-input-with-label
            label="Longitude"
            for="longitude"
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