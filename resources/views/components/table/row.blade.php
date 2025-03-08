{{-- resources/views/components/table/row.blade.php --}}

@props(['entry' => null, 'highlight' => null])

@php
    // Determine highlight class for custom row (if highlight is set)
    $rowClass = '';
    if ($highlight) {
        if (is_object($highlight) && $entry && method_exists($entry, 'is') && $entry->is($highlight)) {
            $rowClass = 'bg-yellow-100';
        }
        if (! is_object($highlight) && $entry && (data_get($entry, 'name') == $highlight || data_get($entry, 'user.id') == $highlight || data_get($entry, 'user_id') == $highlight)) {
            $rowClass = 'bg-yellow-100';
        }
    }
@endphp

<tr {{ $attributes->merge(['class' => $rowClass]) }}>
    {{ $slot }}
    {{-- allow custom cell content --}}
</tr>
