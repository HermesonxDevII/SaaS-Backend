@props(['companies_groups'])

<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
                <th scope="col" class="px-6 py-3"> Nome </th>
                <th scope="col" class="px-6 py-3"> Status </th>
                <th scope="col" class="px-6 py-3"> Ações </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($companies_groups as $company_group)
                <tr class="bg-white border-b border-gray-200">
                    <th scope="row" class="px-6 py-4">
                        {{ $company_group->name }}
                    </th>

                    <td class="px-6 py-4">
                        {{ $company_group->active ? 'Ativo' : 'Inativo' }}
                    </td>

                    <td class="px-6 py-4">
                        <x-icons.components.link link="{{ route('company-groups.show', $company_group->id) }}">
                            <x-icons.eye />
                        </x-icons.components.link>
                        
                        <x-icons.components.link link="{{ route('company-groups.edit', $company_group->id) }}">
                            <x-icons.pen />
                        </x-icons.components.link>

                        <x-icons.components.button
                            data-modal-target="popup-modal"
                            data-modal-toggle="popup-modal"
                        >
                            <x-icons.bin />
                        </x-icons.components.button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <x-company-group::delete-modal
        :company_group="$company_group"
    />
</div>