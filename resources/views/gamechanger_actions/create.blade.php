<x-app-layout>
    <div class="mx-auto max-w-2xl rounded-lg bg-white p-6 shadow-lg">
        <h2 class="mb-4 text-2xl font-semibold">Gamechanger anwenden: {{ $gamechanger->name }}</h2>

        <form action="{{ route('gamechanger_actions.store', $gamechanger->id) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Zielbenutzer:</label>
                <select name="target_user" class="w-full rounded-lg border p-2">
                    <option value="">Kein Benutzer</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="w-full rounded-lg bg-blue-600 py-2 text-white hover:bg-blue-700">
                Anwenden
            </button>
        </form>
    </div>
</x-app-layout>
