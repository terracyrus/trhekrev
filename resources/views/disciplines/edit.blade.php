<x-app-layout>
    <div class="mx-auto max-w-2xl rounded-lg bg-white p-6 shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-800">Ergebnis bearbeiten</h2>

        <p class="mt-1 text-gray-600">
            Disziplin:
            <strong>{{ $discipline->name }}</strong>
        </p>

        <form action="{{ route('disciplines.update', $discipline->id) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')

            <div class="mt-4">
                @if ($discipline->isTime())
                    <label class="block text-gray-700">
                        Dein Ergebnis (Minute:Sekunde):
                        <?php echo $result->points;
                        echo sprintf('/ %02d:%02d', floor($result->points / 60), $result->points % 60); ?>
                    </label>
                    <div class="flex space-x-2">
                        <!-- Minutes Input -->
                        <input
                            type="number"
                            name="minutes"
                            min="0"
                            max="59"
                            value="{{ old('minutes', isset($result) ? floor($result->points / 60) : 0) }}"
                            class="w-1/2 rounded-lg border p-2 text-center"
                            placeholder="Minuten"
                        />

                        <!-- Seconds Input -->
                        <input
                            type="number"
                            name="seconds"
                            min="0"
                            max="59"
                            value="{{ old('seconds', isset($result) ? $result->points % 60 : 0) }}"
                            class="w-1/2 rounded-lg border p-2 text-center"
                            placeholder="Sekunden"
                        />
                    </div>
                @else
                    <label class="block text-gray-700">Dein Ergebnis:</label>
                    <input
                        type="number"
                        name="points"
                        min="0"
                        value="{{ old('points', $result->points) }}"
                        class="w-full rounded-lg border p-2"
                        placeholder="Punkte"
                    />
                @endif
            </div>

            <button type="submit" class="mt-4 w-full rounded-lg bg-blue-600 py-2 text-white hover:bg-blue-700">
                Speichern
            </button>
        </form>

        <a href="{{ route('disciplines.leaderboard', $discipline->id) }}" class="mt-4 block text-center text-blue-600">
            Zurück zur Disziplin
        </a>
    </div>
</x-app-layout>
