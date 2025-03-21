<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">📊{{ __('Dashboard') }}</h2>
    </x-slot>
    <div class="mx-auto max-w-7xl space-y-4 p-2 sm:px-6 lg:px-8">
        <div class="overflow-hidden overflow-x-auto rounded-lg bg-white shadow-lg">
            @if (Auth::user()->isUser())
                @livewire('user-dashboard')
            @endif

            @if ($sortedPlayers->isEmpty() && ! Auth::user()->isViewer())
                <p class="p-4 text-gray-500">Noch keine Ergebnisse verfügbar.</p>
            @else
                @livewire('leaderboard-table')
            @endif
        </div>
    </div>
</x-app-layout>
