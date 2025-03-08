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
            </div>

            <!-- Gamechanger Auswahl -->
            <div class="mb-4">
                <label class="block text-gray-700">Welchen Gamechanger möchtest du nutzen?</label>
                <select name="gamechanger_id" id="gamechanger_id" class="w-full rounded-lg border p-2" disabled>
                    <option value="">-- Bitte zuerst einen Benutzer wählen --</option>
                </select>
            </div>

            <!-- Count Input (Only for Gamechangers with max_executions > 1) -->
            <div class="mb-4 hidden" id="count_wrapper">
                <label class="block text-gray-700">
                    Anzahl (max.
                    <span id="max_count">10</span>
                    ):
                </label>
                <input
                    type="number"
                    name="count"
                    id="count"
                    value="1"
                    min="1"
                    max="10"
                    class="w-full rounded-lg border p-2"
                />
            </div>

            <!-- Target User -->
            <div class="mb-4 hidden" id="target_user_wrapper">
                <label class="block text-gray-700">Zielbenutzer:</label>
                <select name="target_user" id="target_user" class="w-full rounded-lg border p-2">
                    <option value="">Kein Benutzer</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

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
            let targetUser = document.getElementById('target_user');

            // Reset the gamechanger dropdown
            gamechangerDropdown.innerHTML = '<option value="">-- Bitte wählen --</option>';
            gamechangerDropdown.disabled = true;

            // Reset target user selection
            targetUser.value = '';

            if (!userId) return;

            fetch(`/gamechanger/allowed/${userId}`)
                .then((response) => response.json())
                .then((data) => {
                    if (data.length > 0) {
                        gamechangerDropdown.disabled = false;
                        data.forEach((gc) => {
                            let option = document.createElement('option');
                            option.value = gc.id;
                            option.dataset.maxExecutions = gc.max_executions;
                            option.textContent = gc.name + ' (' + gc.min_disciplines + ' Disziplinen)';
                            gamechangerDropdown.appendChild(option);
                        });
                    }
                });

            checkFormValidity();
        });

        document.getElementById('gamechanger_id').addEventListener('change', function () {
            let countWrapper = document.getElementById('count_wrapper');
            let maxCountSpan = document.getElementById('max_count');
            let countInput = document.getElementById('count');
            let targetUserWrapper = document.getElementById('target_user_wrapper');
            let selectedOption = this.options[this.selectedIndex];

            let maxExecutions = selectedOption.dataset.maxExecutions || 1;
            maxExecutions = parseInt(maxExecutions);

            if (maxExecutions > 1) {
                countWrapper.classList.remove('hidden');
                maxCountSpan.textContent = maxExecutions;
                countInput.max = maxExecutions;
            } else {
                countWrapper.classList.add('hidden');
                countInput.value = 1;
            }

            // Hide target user selection for "Neustart" and "Sicherheit!"
            if (selectedOption.text.includes('Neustart') || selectedOption.text.includes('Sicherheit')) {
                targetUserWrapper.classList.add('hidden');
                document.getElementById('target_user').value = '';
            } else {
                targetUserWrapper.classList.remove('hidden');
            }

            checkFormValidity();
        });

        document.getElementById('target_user').addEventListener('change', function () {
            let requester = document.getElementById('requested_by').value;
            let target = this.value;

            if (requester && target && requester === target) {
                alert('Der Zielbenutzer darf nicht der gleiche sein wie der Anfragende!');
                this.value = '';
            }

            checkFormValidity();
        });

        function checkFormValidity() {
            let requestedUser = document.getElementById('requested_by').value;
            let gamechanger = document.getElementById('gamechanger_id').value;
            let targetUser = document.getElementById('target_user').value;
            let submitButton = document.getElementById('submit_button');

            let selectedGamechanger =
                document.getElementById('gamechanger_id').options[
                    document.getElementById('gamechanger_id').selectedIndex
                ].textContent;

            let needsTargetUser = !(
                selectedGamechanger.includes('Neustart') || selectedGamechanger.includes('Sicherheit')
            );

            if (requestedUser && gamechanger && (!needsTargetUser || targetUser)) {
                submitButton.disabled = false;
                submitButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
                submitButton.classList.add('bg-blue-600', 'hover:bg-blue-700', 'text-white');
            } else {
                submitButton.disabled = true;
                submitButton.classList.add('bg-gray-400', 'cursor-not-allowed');
                submitButton.classList.remove('bg-blue-600', 'hover:bg-blue-700', 'text-white');
            }
        }
    </script>
</x-app-layout>
