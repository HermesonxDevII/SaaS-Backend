<a
    href="{{ $link }}"
    @if ($warning ?? false)
        class="p-2 rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800 inline-flex items-center justify-center transition duration-300"
    @else
        class="p-2 rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 inline-flex items-center justify-center transition duration-300"
    @endif
>
    {{ $slot }}
</a>