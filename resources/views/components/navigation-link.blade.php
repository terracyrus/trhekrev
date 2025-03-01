<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route($webRoute)" :active="$active">
        {{ $slot }}
    </x-nav-link>
</div>
