<div class="mx-auto max-w-4xl rounded-lg bg-white p-6 shadow-lg">
    <h2 class="mb-4 text-2xl font-semibold">🔔 Benachrichtigungen</h2>

    {{-- 📌 Unread Notifications (Chat-Style: New on Top) --}}
    <div>
        <h3 class="text-lg font-semibold text-blue-600">📩 Neue Benachrichtigungen</h3>
        <ul class="divide-y divide-gray-300">
            @forelse ($unreadNotifications as $notification)
                <li class="flex justify-between rounded-lg bg-blue-100 p-3">
                    <div>
                        <strong>{{ $notification->data['title'] ?? 'Neue Benachrichtigung' }}</strong>
                        <p class="text-sm text-gray-700">
                            {{ $notification->data['message'] ?? 'Keine Details verfügbar' }}
                        </p>
                    </div>
                </li>
            @empty
                <li class="p-4 text-center text-gray-500">Keine neuen Benachrichtigungen</li>
            @endforelse
        </ul>
    </div>

    {{-- 📌 Read Notifications (Chat-Style: Below) --}}
    <div class="mt-6">
        <h3 class="text-lg font-semibold text-gray-600">📜 Gelesene Benachrichtigungen</h3>
        <ul class="divide-y divide-gray-300">
            @forelse ($readNotifications as $notification)
                <li class="flex justify-between rounded-lg bg-gray-100 p-3">
                    <div>
                        <strong>{{ $notification->data['title'] ?? 'Alte Benachrichtigung' }}</strong>
                        <p class="text-sm text-gray-700">
                            {{ $notification->data['message'] ?? 'Keine Details verfügbar' }}
                        </p>
                    </div>
                </li>
            @empty
                <li class="p-4 text-center text-gray-500">Keine älteren Benachrichtigungen</li>
            @endforelse
        </ul>
    </div>
</div>
