@props([
    'width',
    'height'
])

<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => ($warning ?? false)
            ? 'text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm ' . ($width ?? 'px-5') . ' ' . ($height ?? 'py-2.5') . ' dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800 transition duration-300'
            
            : 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm ' . ($width ?? 'px-5') . ' ' . ($height ?? 'py-2.5') . ' dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 transition duration-300',
    ]) }}
>
    {{ $slot }}
</button>