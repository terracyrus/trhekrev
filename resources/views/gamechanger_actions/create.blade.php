<x-app-layout>
    <div class="mx-auto max-w-2xl rounded-lg bg-white p-6 shadow-lg">
        <h2 class="mb-4 text-2xl font-semibold">Gamechanger anwenden</h2>

        <form action="{{ route('gamechanger_actions.store') }}" method="POST">
            @csrf

            <!-- Requested User -->
            <div class="mb-4">
                <label class="block text-gray-700">Wer hat den Gamechanger angefragt?</label>
                <select name="requested_by" id="requested_by" class="w-full rounded-lg border p-2">
                    <option value="">-- Bitte wählen --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }} (Disziplinen: {{ $user->completedDisciplines() }})
                        </option>
                    @endforeach
                </select>
                @error('requested_by')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gamechanger Auswahl -->
            <div class="mb-4">
                <label class="block text-gray-700">Welchen Gamechanger möchtest du nutzen?</label>
                <select name="gamechanger_id" id="gamechanger_id" class="w-full rounded-lg border p-2" disabled>
                    <option value="">-- Bitte zuerst einen Benutzer wählen --</option>
                </select>
                @error('gamechanger_id')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Target User (optional, wird nur bei bestimmten Gamechangern angezeigt) -->
            <div class="mb-4 hidden" id="target_user_wrapper">
                <label class="block text-gray-700">Zielbenutzer (optional):</label>
                <select name="target_user" class="w-full rounded-lg border p-2">
                    <option value="">Kein Benutzer</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button (Start: Disabled) -->
            <button
                type="submit"
                id="submit_button"
                class="w-full rounded-lg bg-blue-600 py-2 text-white hover:bg-blue-700 disabled:cursor-not-allowed disabled:bg-gray-400"
                disabled
            >
                Anwenden
            </button>
        </form>
    </div>

    <script>
        document.getElementById('requested_by').addEventListener('change', function () {
            let userId = this.value;
            let gamechangerDropdown = document.getElementById('gamechanger_id');
            let submitButton = document.getElementById('submit_button');

            gamechangerDropdown.innerHTML = '<option value="">-- Bitte wählen --</option>';
            gamechangerDropdown.disabled = true;
            gamechangerDropdown.classList.add('bg-gray-200', 'text-gray-500', 'cursor-not-allowed');
            submitButton.disabled = true;
            submitButton.classList.add('bg-gray-400', 'text-gray-700', 'cursor-not-allowed');

            if (!userId) return;

            fetch(`/gamechanger/allowed/${userId}`)
                .then((response) => response.json())
                .then((data) => {
                    if (data.length > 0) {
                        gamechangerDropdown.disabled = false;
                        gamechangerDropdown.classList.remove('bg-gray-200', 'text-gray-500', 'cursor-not-allowed');
                        gamechangerDropdown.classList.add('bg-white', 'text-black');
                        data.forEach((gc) => {
                            let option = document.createElement('option');
                            option.value = gc.id;
                            option.textContent = gc.name + ' (' + gc.min_disciplines + ' Disziplinen)';
                            gamechangerDropdown.appendChild(option);
                        });
                    }
                });
        });

        document.getElementById('gamechanger_id').addEventListener('change', function () {
            let targetUserWrapper = document.getElementById('target_user_wrapper');
            let submitButton = document.getElementById('submit_button');
            let selectedGamechanger = this.options[this.selectedIndex].textContent;

            if (selectedGamechanger.includes('Neustart')) {
                targetUserWrapper.classList.add('hidden');
            } else {
                targetUserWrapper.classList.remove('hidden');
            }

            if (this.value) {
                submitButton.disabled = false;
                submitButton.classList.remove('bg-gray-400', 'text-gray-700', 'cursor-not-allowed');
                submitButton.classList.add('bg-blue-600', 'text-white', 'hover:bg-blue-700');
            } else {
                submitButton.disabled = true;
                submitButton.classList.add('bg-gray-400', 'text-gray-700', 'cursor-not-allowed');
                submitButton.classList.remove('bg-blue-600', 'text-white', 'hover:bg-blue-700');
            }
        });
    </script>
</x-app-layout>
