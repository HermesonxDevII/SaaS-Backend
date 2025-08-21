<div class="flex flex-col">
    <x-input-box>
        <x-input-with-label
            label="Nome"
            name="name"
            :value="$priority->name"
            readonly
        />
    </x-input-box>

    <x-input-box>
        <x-textarea-with-label
            label="Descrição"
            name="description"
            :value="$priority->description ?? 'Sem Descrição'"
            readonly
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="Status"
            name="status"
            value="{{ $priority->active ? 'Ativo' : 'Inativo' }}"
            readonly
        />
    </x-input-box>
</div>