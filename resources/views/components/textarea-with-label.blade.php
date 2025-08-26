@props([
    'name',
    'label',
    'value',
    'rows'
])

<div class="mb-5 w-full">
    <label
        for="{{ $name }}"
        class="block mb-2 text-sm font-medium text-gray-900"
    > {{ $label }} </label>
    
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows ?? '4' }}"
        {{ $attributes->merge([
            'placeholder' => 'Digite um valor',
            'class'       => 'block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 resize-none'
        ]) }}
    >{{ old($name, $value ?? '') }}</textarea>
</div>