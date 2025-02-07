<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">{{ __("You're logged in!") }} with role {{ Auth::user()->role }}</div>
            </div>
        </div>
    </div>
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
        <div class="overflow-hidden rounded-lg bg-white shadow-lg">
            <table class="w-full border-collapse text-left">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="px-6 py-3">{{ __('Platz') }}</th>
                        <th class="px-6 py-3">{{ __('Spieler') }}</th>
                        <th class="px-6 py-3 text-right">{{ __('Punkte') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $index => $result)
                        @php
                            $rank = $index + 1;
                            $isCurrentUser = $rank === 0;
                        @endphp

                        <tr
                            class="{{ $isCurrentUser ? 'bg-blue-200 font-bold' : ($index % 2 === 0 ? 'bg-gray-100' : 'bg-white') }}"
                        >
                            <td class="px-6 py-3 font-bold text-gray-700">#{{ $rank }}</td>
                            <td class="px-6 py-3 text-gray-900">{{ $result->user->name }}</td>
                            <td class="px-6 py-3 text-right font-semibold text-gray-700">
                                {{ $result->total_points }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
