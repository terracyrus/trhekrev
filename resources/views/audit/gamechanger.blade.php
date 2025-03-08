<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Ausgeführte Gamechanger') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-4 p-2 sm:px-6 lg:px-8">
        <div class="overflow-hidden overflow-x-auto rounded-lg bg-white shadow-lg">
            <x-table>
                <x-table.head :headers="['History']" />
                <x-table.body>
                    @foreach ($actions as $action)
                        <x-table.row :entry="$action" :highlight="Auth::id()">
                            <td>
                                {{ $action->gamechanger->name }} wurde auf
                                {{ optional($action->targetUser)->name ?? ' alle Gruppen ' }} durch
                                {{ $action->requestedBy->name }} ausgeführt
                            </td>
                        </x-table.row>
                    @endforeach
                </x-table.body>
            </x-table>
        </div>
    </div>
</x-app-layout>
