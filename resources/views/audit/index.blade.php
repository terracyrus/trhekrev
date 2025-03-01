<x-app-layout>
    <div class="mx-auto max-w-4xl rounded-lg bg-white p-6 shadow-lg">
        <h2 class="mb-4 text-2xl font-semibold">Audit-Logs</h2>
        <table class="w-full border-collapse text-left">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="px-6 py-3">Datum</th>
                    <th class="px-6 py-3">Benutzer</th>
                    <th class="px-6 py-3">Aktion</th>
                    <th class="px-6 py-3">Beschreibung</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr class="border border-gray-300">
                        <td class="px-4 py-2">{{ $log->created_at }}</td>
                        <td class="px-4 py-2">{{ $log->user->name }}</td>
                        <td class="px-4 py-2">{{ $log->action }}</td>
                        <td class="px-4 py-2">{{ $log->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
