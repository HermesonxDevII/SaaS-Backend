<x-alerts />

<form
    action="{{ route('company-segments.update', $company_segment->id) }}"
    method="POST"
    class="flex flex-col"
>
    @method('PUT')
    @csrf
    <div class="mb-5">
        <x-toggle
            name="active"
            label="Ativo"
            :checked="$company_segment->active"
        />
    </div>

    <x-input-box>
        <x-input-with-label
            label="Nome"
            name="name"
            :value="$company_segment->name"
            placeholder="Digite um Nome"
        />
    </x-input-box>

    <x-input-box>
        <x-textarea-with-label
            label="Descrição"
            name="description"
            :value="$company_segment->description"
            placeholder="Digite uma Descrição"
        />
    </x-input-box>

    <div class="w-full flex flex-row justify-end gap-2">
        <x-button type="submit">Salvar</x-button>
        <x-link-button
            link="{{ route('company-segments.index') }}"
            warning
        > Cancelar </x-link-button>
    </div>
</form>