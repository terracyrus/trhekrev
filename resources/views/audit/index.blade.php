<x-app-layout>
    <div class="mx-auto max-w-4xl rounded-lg bg-white p-6 shadow-lg">
        <h2 class="mb-4 text-2xl font-semibold">Audit-Logs</h2>
        <x-table>
            <x-table.head :headers="['Datum', 'Benutzer', 'Aktion', 'Beschreibung']" />
            <x-table.body>
                @foreach ($logs as $log)
                    <x-table.row :entry="$log" class="border border-gray-300">
                        <td>{{ $log->created_at }}</td>
                        <td>{{ $log->user->name }}</td>
                        <td>{{ $log->action }}</td>
                        <td>{{ $log->description }}</td>
                    </x-table.row>
                @endforeach
            </x-table.body>
        </x-table>
    </div>
</x-app-layout>
