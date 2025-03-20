<div class="mx-auto max-w-4xl rounded-lg bg-white p-6 shadow-lg" wire:poll.30s>
    <!-- 📌 User Info -->
    <div class="mb-4 text-center sm:text-left">
        <p class="text-gray-700">
            <strong>👤 Gruppe:</strong>
            {{ $user->name }}
        </p>
    </div>

    @if ($qualified)
        <!-- 🏆 Compact Leaderboard Stats -->
        <div class="mb-6 grid grid-cols-3 gap-3 text-center sm:grid-cols-3">
            <div class="rounded-lg bg-yellow-100 p-3 text-yellow-900">
                <strong>
                    🏅
                    <br />
                    Rang:
                </strong>
                <br />
                {{ $overallRank }}
            </div>
            <div class="rounded-lg bg-blue-100 p-3 text-blue-900">
                <strong>
                    🎯
                    <br />
                    Ziel:
                </strong>
                <br />
                {{ $firstLeaderboardPoints }}
            </div>
            <div class="rounded-lg bg-green-100 p-3 text-green-900">
                <strong>
                    🔥
                    <br />
                    Punkte:
                </strong>
                <br />
                {{ $overallLeaderboardPoints }}
            </div>
        </div>
    @else
        <!-- Hinweis, dass alle Kategorien abgeschlossen sein müssen -->
        <div class="mb-6 grid grid-cols-1">
            <div class="text-900 mb-6 rounded-lg bg-gray-400 p-4 text-center">
                Du musst erst in allen 6 Bereichen mindestens einen Posten absolvieren, um in die Rangliste zu kommen!
            </div>
        </div>
    @endif
    <!-- 📊 Progress Bars -->
    <div class="mb-6 grid grid-cols-2 gap-4">
        <div>
            <strong>🚩 Posten {{ $completedDisciplines }} / {{ $totalDisciplines }}:</strong>
            <div class="mt-2 w-full rounded-lg bg-gray-200">
                <div
                    class="rounded-lg bg-blue-500 py-2 text-center text-xs leading-none text-white"
                    style="width: {{ ($completedDisciplines / $totalDisciplines) * 100 }}%"
                ></div>
            </div>
        </div>

        <div>
            <strong>⭐ Bereiche {{ $completedCategories }} / {{ $totalCategories }}:</strong>
            <div class="mt-2 w-full rounded-lg bg-gray-200">
                <div
                    class="rounded-lg bg-green-500 py-2 text-center text-xs leading-none text-white"
                    style="width: {{ ($completedCategories / $totalCategories) * 100 }}%"
                ></div>
            </div>
        </div>
    </div>
    <!-- ⚡ Gamechanger -->
    <div class="mb-6">
        <strong>⚡ Freigeschaltete Gamechanger:</strong>
        <ul class="mt-2 grid list-none grid-cols-2 gap-2 text-gray-700 sm:grid-cols-3">
            @forelse ($availableGamechangers as $gamechanger)
                <li class="flex items-center justify-center rounded-lg bg-gray-100 p-2">
                    <span class="inline-flex h-4 w-4 items-center justify-center">{!! $gamechanger->icon !!}</span>
                    <span class="ml-2">{{ $gamechanger->name }}</span>
                </li>
            @empty
                <li class="col-span-2 text-center text-gray-500">🔒 Noch keine Gamechanger freigeschaltet.</li>
            @endforelse
        </ul>
    </div>
</div>
