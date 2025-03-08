<x-app-layout>
    <div class="mx-auto max-w-4xl rounded-lg bg-white p-6 shadow-md">
        <h2 class="text-2xl font-bold text-gray-800">{{ __('Zielrangliste') }}</h2>
        <x-table>
            <x-table.head :headers="['Platz', 'Gruppe', 'Punkte']" />
            <x-table.body>
                @foreach ($leaderboard as $index => $entry)
                    <x-table.row :entry="$entry" :highlight="Auth::id()">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $entry->user->name }}</td>
                        <td>{{ $entry->points }}</td>
                    </x-table.row>
                @endforeach
            </x-table.body>
        </x-table>
    </div>
</x-app-layout>
