{{-- resources/views/components/table/body.blade.php --}}

@props(['data' => null, 'columns' => [], 'highlight' => null])

<tbody {{ $attributes->merge(['class' => 'bg-white divide-y divide-gray-200 p-2']) }}>
    @if ($slot->isNotEmpty())
        <!-- Use custom row definitions if provided -->
        {{ $slot }}
    @elseif ($data)
        @foreach ($data as $entry)
            @php
                // Determine highlight class for this row (if highlight is set)
                $highlightClass = '';
                if ($highlight) {
                    // If highlight is an object (e.g., a User model), compare by object
                    if (is_object($highlight) && method_exists($entry, 'is') && $entry->is($highlight)) {
                        $highlightClass = 'bg-yellow-100';
                    }
                    // If highlight is a value (e.g., an ID), compare to entry's id or nested user id
                    if (
                        ! is_object($highlight) &&
                        (data_get($entry, 'id') == $highlight ||
                            data_get($entry, 'user.id') == $highlight ||
                            data_get($entry, 'user_id') == $highlight)
                    ) {
                        $highlightClass = 'bg-yellow-100';
                    }
                }
            @endphp

            <tr class="{{ $highlightClass }}">
                @foreach ($columns as $colKey)
                    <td class="border-t border-gray-200 px-4 py-2">
                        {{ data_get($entry, $colKey) }}
                    </td>
                @endforeach
            </tr>
        @endforeach
    @endif
</tbody>
