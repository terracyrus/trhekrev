<x-app-layout>
    <div class="mx-auto max-w-7xl rounded-lg bg-white p-6 shadow-lg">
        <h2 class="mb-4 text-2xl font-semibold">Ausgeführte Gamechanger</h2>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Gamechanger</th>
                    <th class="border p-2">Angefordert von</th>
                    <th class="border p-2">Ausgeführt von</th>
                    <th class="border p-2">Zielbenutzer</th>
                    <th class="border p-2">Aktion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($actions as $action)
                    <tr class="border">
                        <td class="border p-2">{{ $action->gamechanger->name }}</td>
                        <td class="border p-2">{{ $action->requestedBy->name }}</td>
                        <td class="border p-2">{{ $action->executedBy->name }}</td>
                        <td class="border p-2">{{ optional($action->targetUser)->name ?? '-' }}</td>
                        <td class="border p-2">{{ $action->gamechanger->effect }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
