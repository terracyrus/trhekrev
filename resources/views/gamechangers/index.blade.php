<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Gamechanger Übersicht') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-4 p-2 sm:px-6 lg:px-8">
        <div class="overflow-hidden overflow-x-auto rounded-lg bg-white shadow-lg">
            <x-table>
                <x-table.head :headers="['Icon', 'Name', 'Mindestanzahl']" />
                <x-table.body>
                    @foreach ($gamechangers as $gamechanger)
                        <x-table.row :entry="$gamechanger">
                            <td>{!! $gamechanger->icon !!}</td>
                            <td>{{ $gamechanger->name }}</td>
                            <td>{{ $gamechanger->min_disciplines }}</td>
                        </x-table.row>
                    @endforeach
                </x-table.body>
            </x-table>
        </div>
    </div>
</x-app-layout>
