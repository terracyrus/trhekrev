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
                <table class="min-w-full border-collapse text-left sm:table-auto lg:table-fixed">
                    <thead>
                        <tr class="overflow-x-auto bg-gray-800 text-white">
                            <th class="px-6 py-3">{{ __('Platz') }}</th>
                            <th class="px-6 py-3">{{ __('Gruppe') }}</th>
                            <th class="px-6 py-3">{{ __('Differenz') }}</th>
                            <th class="px-6 py-3 text-right">{{ __('Gesamtpunkte') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sortedPlayers as $index => $entry)
                            <tr
                                class="{{ auth()->id() == $entry->user->id ? 'bg-yellow-100 font-bold' : 'bg-white' }}"
                            >
                                <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $entry->user->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $entry->difference }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-right">
                                    {{ $entry->first_points }} / {{ $entry->overall_points }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
