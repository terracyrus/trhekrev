<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Rangliste') }} {{ $discipline->name }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-4 p-2 sm:px-6 lg:px-8">
        <h4 class="mb-6 text-center text-xl font-bold text-gray-800">
            @if ($position > 0)
                🏆 Du bist auf dem {{ $position }}. Platz!
            @else
                Du bist nicht in der Rangliste!
            @endif
        </h4>

        <a
            href="{{ route('disciplines.edit', $discipline->id) }}"
            class="flex items-center justify-center rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-700"
        >
            {{ $position > 0 ? 'Punktzahl anpassen' : 'Punkte erfassen' }}
        </a>

        @if (session('success'))
            <div
                id="success-message"
                class="fixed right-5 top-5 rounded-lg bg-green-500 px-4 py-2 text-white shadow-md"
            >
                {{ session('success') }}
            </div>

            <script>
                // Automatically fade out the notification after 3 seconds
                setTimeout(() => {
                    document
                        .getElementById('success-message')
                        ?.classList.add('opacity-0', 'transition-opacity', 'duration-1000');
                    setTimeout(() => document.getElementById('success-message')?.remove(), 1000);
                }, 3000);
            </script>
        @endif

        <div class="overflow-hidden rounded-lg bg-white shadow-lg">
            <table class="w-full border-collapse text-left">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="px-6 py-3">{{ __('Platz') }}</th>
                        <th class="px-6 py-3">{{ __('Spieler') }}</th>
                        <th class="px-6 py-3 text-right">{{ __($discipline->type) }}</th>
                        <th class="px-6 py-3 text-right">Erhaltene Punkte</th>
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
                            <td class="px-6 py-3 text-right font-semibold text-gray-700">
                                {{ $result->score }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-1 text-right">Platzierung von {{ $discipline->sortTableFor('text') }}</div>
        </div>
    </div>
</x-app-layout>
