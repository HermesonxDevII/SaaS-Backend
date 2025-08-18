<x-alerts />

<form
    action="{{ route('responsible-teams.store') }}"
    method="POST"
    class="flex flex-col"
>
    @csrf
    <x-input-box>
        <x-input-with-label
            label="Nome *"
            for="name"
            name="name"
            placeholder="Digite o Nome da Equipe"
            required
        />
    </x-input-box>

    <div class="w-full flex flex-row justify-end gap-2">
        <x-button type="submit">Salvar</x-button>
        <x-link-button
            link="{{ route('responsible-teams.index') }}"
            warning
        > Cancelar </x-link-button>
    </div>
</form>