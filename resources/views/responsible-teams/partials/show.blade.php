<div class="flex flex-col">
    <x-input-box>
        <x-input-with-label
            label="Nome"
            name="name"
            :value="$responsible_team->name"
            readonly
        />
    </x-input-box>

    <x-input-box>
        <x-textarea-with-label
            label="Descrição"
            name="description"
            :value="$responsible_team->description ?? 'Sem Descrição'"
            readonly
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="Status"
            name="status"
            value="{{ $responsible_team->active ? 'Ativo' : 'Inativo' }}"
            readonly
        />
    </x-input-box>
</div>