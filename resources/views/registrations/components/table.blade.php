<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
                <th scope="col" class="px-6 py-3"> Nome </th>
                <th scope="col" class="px-6 py-3"> Quantidade </th>
                <th scope="col" class="px-6 py-3"> Ações </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($values as $value)
                <tr class="bg-white border-b border-gray-200">
                    <th scope="row" class="px-6 py-4">
                        {{ $value->name }}
                    </th>

                    <td class="px-6 py-4">
                        {{ $value->quantity }}
                    </td>

                    <td class="px-6 py-4">
                        <x-icons.components.link link="{{ $value->route }}">
                            <x-icons.eye />
                        </x-icons.components.link>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>