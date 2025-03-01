<x-app-layout>
    <div class="mx-auto max-w-7xl rounded-lg bg-white p-6 shadow-lg">
        <h2 class="mb-4 text-2xl font-semibold">Ausgeführte Gamechanger</h2>
        <x-table>
            <x-table.head :headers="['History']" />
            <x-table.body>
                @foreach ($actions as $action)
                    <x-table.row :entry="$action" :highlight="Auth::id()">
                        <td>
                            {{ $action->gamechanger->name }} wurde auf
                            {{ optional($action->targetUser)->name ?? '-' }} durch {{ $action->requestedBy->name }}
                            ausgeführt
                        </td>
                    </x-table.row>
                @endforeach
            </x-table.body>
        </x-table>
    </div>
</x-app-layout>
