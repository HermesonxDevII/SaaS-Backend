@props(['solicitation_types'])

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
            @foreach ($solicitation_types as $solicitation_type)
                <tr class="bg-white border-b border-gray-200">
                    <th scope="row" class="px-6 py-4">
                        {{ $solicitation_type->name }}
                    </th>

                    <td class="px-6 py-4">
                        {{ $solicitation_type->active ? 'Ativo' : 'Inativo' }}
                    </td>

                    <td class="px-6 py-4">
                        <x-icons.components.link link="{{ route('solicitation-types.show', $solicitation_type->id) }}">
                            <x-icons.eye />
                        </x-icons.components.link>
                        
                        <x-icons.components.link link="{{ route('solicitation-types.edit', $solicitation_type->id) }}">
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

    <x-solicitation-type::delete-modal
        :solicitation_type="$solicitation_type"
    />
</div>