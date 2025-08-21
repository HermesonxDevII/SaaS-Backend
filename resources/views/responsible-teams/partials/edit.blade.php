<x-alerts />

<form
    action="{{ route('responsible-teams.update', $responsible_team->id) }}"
    method="POST"
    class="flex flex-col"
>
    @method('PUT')
    @csrf
    <div class="mb-5">
        <x-toggle
            name="active"
            label="Ativo"
            :checked="$responsible_team->active"
        />
    </div>

    <x-input-box>
        <x-input-with-label
            label="Nome"
            name="name"
            :value="$responsible_team->name"
            placeholder="Digite um Nome"
        />
    </x-input-box>

    <x-input-box>
        <x-textarea-with-label
            label="Descrição"
            name="description"
            :value="$responsible_team->description"
            placeholder="Digite uma Descrição"
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