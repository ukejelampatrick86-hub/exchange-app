<form method="POST" action="{{ route('exchange.convert') }}" class="space-y-4 max-w-xl mx-auto">
    @csrf 

    {{-- De --}}
    <div>
        <label class="block font-medium text-gray-700 mb-1">From :</label>
        <select name="from_currency_id" class="w-full border rounded p-2" required>
            @foreach($currencies as $currency)
                <option value="{{ $currency->id }}">
                    {{ $currency->code }} - {{ $currency->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- À --}}
    <div>
        <label class="block font-medium text-gray-700 mb-1">To :</label>
        <select name="to_currency_id" class="w-full border rounded p-2" required>
            @foreach($currencies as $currency)
                <option value="{{ $currency->id }}">
                    {{ $currency->code }} - {{ $currency->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Montant envoyé --}}
    <div>
        <label class="block font-medium text-gray-700 mb-1">Amount sent :</label>
        <input type="number"
               name="amount_from"
               step="0.01"
               min="0.01"
               required
               class="w-full border rounded p-2"
               placeholder="Enter amount">
    </div>

    {{-- Montant reçu (calculé ou rempli côté backend) --}}
    <input type="hidden" name="amount_to" value="0">

    {{-- Taux --}}
    <input type="hidden" name="rate" value="0">

    {{-- Bouton --}}
    <div class="text-center">
        <button type="submit"
                class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700 transition">
            Convert
        </button>
    </div>
</form>
