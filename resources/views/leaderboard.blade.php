<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ __('Rangliste') }} {{ $disciplineName }}</h2>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-4 p-2 sm:px-6 lg:px-8">
        <h1>Dein Rang {{ $username }} ist {{ $position }}</h1>
        <table class="table-auto" border="1">
            <thead>
                <tr>
                    <th>Platz</th>
                    <th>Name</th>
                    <th>Punkte</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $index => $result)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $result->name }}</td>
                        <td>{{ $result->points }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
