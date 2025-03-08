<div class="fixed bottom-0 left-0 flex w-full justify-around border-t bg-white py-2 shadow-lg sm:hidden">
    @php
        $currentRoute = request()
            ->route()
            ->getName();
    @endphp

    @foreach ($links as $link)
        <a
            href="{{ route($link['route']) }}"
            class="{{ str_contains($currentRoute, $link['route']) ? 'text-blue-500' : 'text-gray-600 hover:text-blue-500' }} relative flex flex-col items-center"
        >
            <svg
                class="h-6 w-6"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
            >
                @if ($link['icon'] === 'home')
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                    />
                @elseif ($link['icon'] === 'goals')
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5"
                    />
                @elseif ($link['icon'] === 'thunder')
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"
                    />
                @elseif ($link['icon'] === 'history')
                    {{-- 🔔 Notifications Icon --}}
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 17h5l-1.405-1.405A4.978 4.978 0 0 1 18 12.5V10a6 6 0 1 0-12 0v2.5c0 .828-.34 1.58-.595 2.095L4 17h5m6 0a3 3 0 1 1-6 0"
                    />
                @endif
            </svg>

            @if ($link['icon'] === 'history')
                @livewire('notification-badge')
            @endif

            <span class="text-xs">{{ $link['label'] }}</span>
        </a>
    @endforeach
</div>
