{{-- resources/views/components/table/head.blade.php --}}

@props([
    'headers',
])

<thead class="bg-gray-50">
    <tr class="border-b border-gray-300">
        @foreach ($headers as $header)
            <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">
                {{ __($header) }}
            </th>
        @endforeach
    </tr>
</thead>
