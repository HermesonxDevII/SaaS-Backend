<x-alerts />

<form
    action="{{ route('company-segments.store') }}"
    method="POST"
    class="flex flex-col"
>
    @csrf
    <x-input-box>
        <x-input-with-label
            label="Nome *"
            for="name"
            name="name"
            placeholder="Digite um Nome"
            required
        />
    </x-input-box>

    <x-input-box>
        <x-textarea-with-label
            label="Descrição"
            name="description"
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