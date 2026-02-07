<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Convertisseur de devises
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <!-- Formulaire -->
                <form id="exchange-form">
                    @csrf

                    <div class="mb-4">
                        <label for="from_currency_id" class="block font-semibold mb-1">De :</label>
                        <select name="from_currency_id" id="from_currency_id" class="w-full border rounded p-2">
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}">{{ $currency->name }} ({{ $currency->code }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="to_currency_id" class="block font-semibold mb-1">À :</label>
                        <select name="to_currency_id" id="to_currency_id" class="w-full border rounded p-2">
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}">{{ $currency->name }} ({{ $currency->code }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="amount" class="block font-semibold mb-1">Montant :</label>
                        <input type="number" name="amount" id="amount" class="w-full border rounded p-2" step="0.01" min="0" required>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Convertir
                    </button>
                </form>

                <!-- Résultat -->
                <div id="result" class="mt-4 text-lg font-bold text-green-600"></div>

            </div>

        </div>
    </div>

    <x-slot name="scripts">
        <script>
        document.getElementById('exchange-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = e.target;
            const data = new FormData(form);

            const responseDiv = document.getElementById('result');
            responseDiv.textContent = 'Calcul en cours...';

            try {
                const response = await fetch("{{ route('exchange.convert') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': data.get('_token'),
                        'Accept': 'application/json'
                    },
                    body: data
                });

                const result = await response.json();

                if (response.ok) {
                    responseDiv.textContent = `Montant converti : ${result.amount_to.toFixed(2)}`;
                } else {
                    responseDiv.textContent = result.message || 'Erreur lors de la conversion.';
                }
            } catch (error) {
                responseDiv.textContent = 'Erreur serveur : ' + error;
            }
        });
        </script>
    </x-slot>
</x-app-layout>
