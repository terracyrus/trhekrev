<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Alle Posten') }}
        </h2>
    </x-slot>
    <div class="mx-auto max-w-7xl p-2 sm:px-6 lg:px-8">
        <div class="grid grid-cols-3 gap-3">
            @foreach ($disciplines as $discipline)
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <a href="/leaderboard/{{ $discipline->id }}">{{ $discipline->name }}</a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
