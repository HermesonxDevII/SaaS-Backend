@foreach ($objects as $object)
    <tr class="bg-white border-b border-gray-200">
        <th scope="row" class="px-6 py-4">
            {{ $object->name }}
        </th>

        @if($showQuantity ?? false)
            <td class="px-6 py-4">
                {{ $object->quantity }}
            </td>
        @endif

        @if($showStatus ?? false)
            <td class="px-6 py-4">
                {{ getStatus($object->active) }}
            </td>
        @endif

        <td class="px-6 py-4">
            Ações
        </td>
    </tr>
@endforeach