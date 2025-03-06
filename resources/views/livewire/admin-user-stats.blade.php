<div wire:poll.5s class="rounded-lg bg-white p-4 shadow-lg">
    <h2 class="text-lg font-semibold">Benutzerübersicht</h2>
    <table class="mt-2 w-full border border-gray-300">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="px-4 py-2">Rolle</th>
                <th class="px-4 py-2 text-right">Anzahl</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr class="border border-gray-300">
                    <td class="px-4 py-2">{{ ucfirst(strtolower($role->value)) }}</td>
                    <td class="px-4 py-2 text-right">{{ $userStats[$role->value] ?? 0 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
