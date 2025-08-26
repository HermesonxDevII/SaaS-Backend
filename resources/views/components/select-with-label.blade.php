@props([
    'name',
    'label',
    'placeholder',
    'options',
    'optionField',
    'value'
])

<div class="mb-5 w-full">
    <label
        for="{{ $name }}"
        class="block ml-0.5 mb-2 text-sm font-medium text-gray-900"
    > {{ $label }} </label>
    
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes->merge([
            'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5'
        ]) }}
    >
        <option
            value=""
            @selected(old($name, $value ?? '') == '')
            disabled
        > {{ $placeholder ?? 'Selecione uma opção' }} </option>

        @foreach ($options as $option)
            <option
                value="{{ $option->id }}"
                @selected(old($name, $value ?? '') == $option->id)
            > {{ $option->{$optionField ?? 'name'} }} </option>
        @endforeach
    </select>
</div>