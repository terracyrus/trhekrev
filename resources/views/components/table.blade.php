{{-- resources/views/components/table.blade.php --}}
<div class="overflow-x-auto">
    <!-- enables horizontal scroll on small screens :contentReference[oaicite:1]{index=1} -->
    <table class="table-default min-w-full bg-white shadow-md">
        {{ $slot }}
        {{-- Slot will include the table head and body components --}}
    </table>
</div>
