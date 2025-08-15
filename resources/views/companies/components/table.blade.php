<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
                <th scope="col" class="px-6 py-3"> Razão Social </th>
                <th scope="col" class="px-6 py-3"> Nome Fantasia </th>
                <th scope="col" class="px-6 py-3"> CPF/CNPJ </th>
                <th scope="col" class="px-6 py-3"> Status </th>
                <th scope="col" class="px-6 py-3"> Ações </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($companies as $company)
                <tr class="bg-white border-b border-gray-200">
                    <th scope="row" class="px-6 py-4">
                        {{ $company->corporate_reason }}
                    </th>

                    <td class="px-6 py-4">
                        {{ $company->fantasy_name }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $company->cpf_cnpj }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $company->active === 1 ? 'Ativo' : 'Inativo' }}
                    </td>

                    <td class="px-6 py-4">
                        <x-icon-button link="{{ route('companies.show', $company->id) }}">
                            <x-icons.eye />
                        </x-icon-button>
                        
                        <x-icon-button link="{{ route('companies.edit', $company->id) }}">
                            <x-icons.pen />
                        </x-icon-button>
                        
                        <x-icon-button link="#">
                            <x-icons.bin />
                        </x-icon-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>