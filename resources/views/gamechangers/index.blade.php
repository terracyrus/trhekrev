<x-app-layout>
    <div class="mx-auto max-w-7xl rounded-lg bg-white p-6 shadow-lg">
        <h2 class="mb-4 text-2xl font-semibold">Gamechanger Übersicht</h2>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Icon</th>
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Mindestanzahl</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gamechangers as $gamechanger)
                    <tr class="border">
                        <td class="border p-2">{!! $gamechanger->icon !!}</td>
                        <td class="border p-2">{{ $gamechanger->name }}</td>
                        <td class="border p-2">{{ $gamechanger->min_disciplines }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
