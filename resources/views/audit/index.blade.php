<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Audit-Logs') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-4 p-2 sm:px-6 lg:px-8">
        <div class="overflow-hidden overflow-x-auto rounded-lg bg-white shadow-lg">
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
    </div>
</x-app-layout>
