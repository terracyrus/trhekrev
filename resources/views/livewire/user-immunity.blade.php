<div wire:poll.1s>
    @if ($isImmune)
        <div class="rounded-lg bg-yellow-100 p-4 text-yellow-900">
            🛡️ Du bist noch
            <strong>{{ $remainingTime }}</strong>
            Minuten gegen Gamechanger immun.
        </div>
    @endif
</div>
