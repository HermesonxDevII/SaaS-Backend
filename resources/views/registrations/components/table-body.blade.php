@foreach ($values as $value)
    <tr class="bg-white border-b border-gray-200">
        <th scope="row" class="px-6 py-4">
            {{ $value->name }}
        </th>

        <td class="px-6 py-4">
            {{ $value->quantity }}
        </td>

        <td class="px-6 py-4">
            <a
                href="{{ $value->route }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
            > Visualizar </a>
        </td>
    </tr>
@endforeach