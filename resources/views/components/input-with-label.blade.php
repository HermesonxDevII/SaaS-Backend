<div class="mb-5 w-full">
    <label
        for="{{ $for ?? $name }}"
        class="block ml-0.5 mb-2 text-sm font-medium text-gray-900"
    > {{ $label }} </label>
    
    <input
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        value="{{ old($name, $value ?? '') }}"
        {{ $attributes->merge([
            'type'        => 'text',
            'placeholder' => 'Digite um valor',
            'class'       => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5'
        ]) }}
    />
</div>