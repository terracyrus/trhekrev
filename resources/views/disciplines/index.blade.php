<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Alle Posten') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-7xl p-2 sm:px-6 lg:px-8">
        <!-- Kategorie-Filter -->
        <form method="GET" action="{{ route('disciplines') }}" class="mb-4">
            <label for="category" class="block font-semibold text-gray-700">Kategorie auswählen:</label>
            <select
                id="category"
                name="category_id"
                class="mt-1 block w-full rounded-md border border-gray-300 p-2"
                onchange="this.form.submit()"
            >
                <option value="">Alle Kategorien</option>
                @foreach (\App\Models\Category::all() as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ request('category_id') == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </form>

        <!-- Anzeige der Disziplinen nach Kategorie -->
        @foreach ($categories as $category)
            <h2 class="mt-6 text-xl font-semibold text-gray-700">{{ $category->name }}</h2>

            <div class="grid grid-cols-4 gap-3">
                @foreach ($category->disciplines as $discipline)
                    <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                        <a href="/disciplines/{{ $discipline->id }}" class="text-blue-600 hover:underline">
                            {{ $discipline->name }}
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</x-app-layout>
