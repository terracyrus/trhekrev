<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="mb-4 text-xl font-bold">Admin Dashboard</h1>

        <!-- Flash-Messages -->
        @if (session('success'))
            <div class="mb-4 bg-green-500 p-2 text-white">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.users.delete-x') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="rounded bg-red-500 px-4 py-2 text-white">
                Alle Benutzer mit Rolle User löschen
            </button>
        </form>

        <form action="{{ route('admin.game.reset') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="rounded bg-red-500 px-4 py-2 text-white">Spiel zurücksetzen</button>
        </form>

        <h2 class="mt-6 text-lg font-semibold">Grupen initialisieren</h2>
        <form action="{{ route('admin.game.create') }}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit" class="rounded bg-green-500 px-4 py-2 text-white">User initialisieren</button>
        </form>

        <h2 class="mt-6 text-lg font-semibold">Neuen Benutzer anlegen</h2>
        <form action="{{ route('admin.users.create') }}" method="POST" class="mt-2">
            @csrf
            <input type="text" name="name" placeholder="Name" required class="border p-2" />
            <input type="password" name="password" placeholder="Passwort" required class="border p-2" />
            <select name="role" required class="border p-2">
                <option value="user">User</option>
                <option value="operator">Operator</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit" class="rounded bg-blue-500 px-4 py-2 text-white">Erstellen</button>
        </form>

        @livewire('admin-user-stats')
    </div>
</x-app-layout>
