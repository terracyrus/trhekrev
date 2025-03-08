<span wire:poll.5s>
    @if ($unreadCount > 0)
        <span class="absolute -right-2 -top-1 rounded-full bg-red-500 px-2 py-1 text-xs font-bold text-white">
            {{ $unreadCount }}
        </span>
    @endif
</span>
