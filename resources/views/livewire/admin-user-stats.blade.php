<div wire:poll.5s class="rounded-lg bg-white p-4 shadow-lg">
    <h2 class="text-lg font-semibold">Benutzerübersicht</h2>

    <x-table>
        <x-table.head :headers="['Rolle', 'Anzahl']" />
        <x-table.body>
            @foreach ($roles as $role)
                <x-table.row>
                    <td class="text-left">{{ ucfirst(strtolower($role->value)) }}</td>
                    <td class="text-right">{{ $userStats[$role->value] ?? 0 }}</td>
                </x-table.row>
            @endforeach
        </x-table.body>
    </x-table>
</div>
