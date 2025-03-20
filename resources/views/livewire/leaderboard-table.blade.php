<div wire:poll.5s>
    <!-- Refresh table every 5 seconds -->
    <x-table>
        <x-table.head :headers="['Platz', 'Gruppe', 'Differenz', 'Ziel / Punkte / Bereiche / Posten']" />
        <x-table.body>
            @foreach ($sortedPlayers as $index => $entry)
                <x-table.row :entry="$entry" :highlight="Auth::id()">
                    <td>
                        @if ($entry->completed_categories >= App\Models\Category::count())
                            {{ $index + 1 }}
                        @endif
                    </td>
                    <td>{{ $entry->user->name }}</td>
                    <td>{{ $entry->difference }}</td>
                    <td class="text-right">
                        <p class="font-bold">{{ $entry->first_points }}</p>
                        / {{ $entry->overall_points }} / {{ $entry->completed_categories }} /
                        {{ $entry->completed_disciplines }}
                    </td>
                </x-table.row>
            @endforeach
        </x-table.body>
    </x-table>
    <div class="p-1 text-right">Die Tabelle wird alle 30 Sekunden aktualisiert</div>
    <div class="p-1 text-right">
        Die Reihenfolge wird definiert durch Differenz der Punkte, dann Anzahl abgeschlossener Posten
    </div>
</div>
