<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Rangliste') }} {{ $discipline->name }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-4 p-2 sm:px-6 lg:px-8">
        <h1 class="mb-6 text-center text-3xl font-bold text-gray-800">
            @php
                if ($position > 0) {
                    echo "🏆 Du bist auf dem  ${position}. Platz!";
                } else {
                    echo 'Du bist nicht in der Rangliste!';
                }
            @endphp
        </h1>

        <div class="overflow-hidden rounded-lg bg-white shadow-lg">
            <table class="w-full border-collapse text-left">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="px-6 py-3">{{ __('Platz') }}</th>
                        <th class="px-6 py-3">{{ __('Spieler') }}</th>
                        <th class="px-6 py-3 text-right">{{ __($discipline->type) }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $index => $result)
                        @php
                            $rank = $index + 1;
                            $isCurrentUser = $rank === $position;
                        @endphp

                        <tr
                            class="{{ $isCurrentUser ? 'bg-blue-200 font-bold' : ($index % 2 === 0 ? 'bg-gray-100' : 'bg-white') }}"
                        >
                            <td class="px-6 py-3 font-bold text-gray-700">#{{ $rank }}</td>
                            <td class="px-6 py-3 text-gray-900">{{ $result->name }}</td>
                            <td class="px-6 py-3 text-right font-semibold text-gray-700">
                                {{ $result->formatted_points }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-1 text-right">Sortierung {{ $discipline->sortTableFor('text') }}</div>
        </div>
    </div>
</x-app-layout>
