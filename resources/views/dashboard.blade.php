<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @can('admin-access')
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <a href="/admin">Admin Panel</a>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    <div class="mx-auto max-w-7xl space-y-4 p-2 sm:px-6 lg:px-8">
        <div class="overflow-hidden overflow-x-auto rounded-lg bg-white shadow-lg">
            @if ($sortedPlayers->isEmpty())
                <p class="p-4 text-gray-500">Noch keine Ergebnisse verfügbar.</p>
            @else
                <x-table>
                    <x-table.head :headers="['Platz', 'Gruppe', 'Differenz', 'Punkte']" />
                    <x-table.body>
                        @foreach ($sortedPlayers as $index => $entry)
                            <x-table.row :entry="$entry" :highlight="Auth::id()">
                                <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $entry->user->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $entry->difference }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-right">
                                    {{ $entry->first_points }} / {{ $entry->overall_points }}
                                </td>
                            </x-table.row>
                        @endforeach
                    </x-table.body>
                </x-table>
            @endif
        </div>
    </div>
</x-app-layout>
