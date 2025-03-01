<div class="fixed bottom-0 left-0 flex w-full justify-around border-t bg-white py-2 shadow-lg sm:hidden">
    @php
        $currentRoute = request()
            ->route()
            ->getName();
    @endphp

    @foreach ($links as $link)
        <a
            href="{{ route($link['route']) }}"
            class="{{ str_contains($currentRoute, $link['route']) ? 'text-blue-500' : 'text-gray-600 hover:text-blue-500' }} flex flex-col items-center"
        >
            <svg
                class="h-6 w-6"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
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
                @elseif ($link['icon'] === 'switch')
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 14l-2-2m0 0l-2 2m2-2V6m0 6h2m4 4l-2-2m0 0l-2 2m2-2V6m0 6h2"
                    ></path>
                @elseif ($link['icon'] === 'history')
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z"
                    ></path>
                @endif
            </svg>
            <span class="text-xs">{{ $link['label'] }}</span>
        </a>
    @endforeach
</div>
