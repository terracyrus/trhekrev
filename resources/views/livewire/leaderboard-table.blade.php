<div wire:poll.5s>
    <!-- Refresh table every 5 seconds -->
    <x-table>
        <x-table.head :headers="['Platz', 'Gruppe', 'Differenz', 'Punkte']" />
        <x-table.body>
            @foreach ($sortedPlayers as $index => $entry)
                <x-table.row :entry="$entry" :highlight="Auth::id()">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $entry->user->name }}</td>
                    <td>{{ $entry->difference }}</td>
                    <td class="text-right">{{ $entry->first_points }} / {{ $entry->overall_points }}</td>
                </x-table.row>
            @endforeach
        </x-table.body>
    </x-table>
</div>
