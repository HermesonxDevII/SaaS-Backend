<div class="mb-5 w-full">
    <label
        for="{{ $for ?? '' }}"
        class="block ml-0.5 mb-2 text-sm font-medium text-gray-900"
    > {{ $label }} </label>
    
    <input
        type="{{ $type ?? 'text' }}"
        name="{{ $name }}"
        id="{{ $id ?? '' }}"
        placeholder="{{ $placeholder ?? '' }}"
        value="{{ old($name, $value ?? '') }}"
        @if(!empty($required) && $required) required @endif
        @if(!empty($readonly) && $readonly) readonly @endif
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
    />
</div>