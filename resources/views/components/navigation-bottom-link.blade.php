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
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9m0 0l9 9m-9-9v18"></path>
                @elseif ($link['icon'] === 'menu')
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"></path>
                @elseif ($link['icon'] === 'switch')
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 14l-2-2m0 0l-2 2m2-2V6m0 6h2m4 4l-2-2m0 0l-2 2m2-2V6m0 6h2"
                    ></path>
                @elseif ($link['icon'] === 'user')
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5.121 17.804A4 4 0 017 16h10a4 4 0 011.879.804M12 12a4 4 0 100-8 4 4 0 000 8z"
                    ></path>
                @endif
            </svg>
            <span class="text-xs">{{ $link['label'] }}</span>
        </a>
    @endforeach
</div>
