<x-app-layout>
    <div class="mx-auto max-w-4xl rounded-lg bg-white p-6 shadow-md">
        <h2 class="text-2xl font-bold text-gray-800">First Leaderboard</h2>
        <table class="mt-4 w-full border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 text-left">Platz</th>
                    <th class="p-2 text-left">Name</th>
                    <th class="p-2 text-left">Punkte</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leaderboard as $index => $entry)
                    <tr class="border-t">
                        <td class="p-2">{{ $index + 1 }}</td>
                        <td class="p-2">{{ $entry->user->name }}</td>
                        <td class="p-2">{{ $entry->points }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
