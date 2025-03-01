<x-app-layout>
    <div class="mx-auto max-w-7xl rounded-lg bg-white p-6 shadow-lg">
        <h2 class="mb-4 text-2xl font-semibold">Gamechanger Übersicht</h2>
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
</x-app-layout>
