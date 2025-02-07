<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <a
        href="{{ route('login') }}"
        class="flex content-center justify-center rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-700"
    >
        Login
    </a>
</x-guest-layout>
