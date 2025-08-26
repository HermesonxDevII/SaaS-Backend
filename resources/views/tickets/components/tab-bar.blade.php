@props([
    'ticket'
])

<ul
    class="flex flex-wrap text-sm font-medium text-center text-gray-500"
>
    <li class="me-2">
        <a
            href="#"
            aria-current="page"
            class="inline-block p-2 text-blue-600 bg-gray-100 rounded-t-lg active"
        > Ticket #{{ $ticket->id }} </a>
    </li>

    <li class="me-2">
        <a
            href="#"
            class="inline-block p-2 rounded-t-lg hover:text-gray-600 hover:bg-gray-50"
        > Anexos </a>
    </li>
</ul>