<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Conversions of Currencies
        </h2>
    </x-slot>

    {{-- Contenu plein écran --}}
    <div class="py-6 px-6">
        <div class="mx-auto max-w-screen-2xl">

            {{-- Card --}}
            <div class="bg-white shadow rounded-lg p-6">

                {{-- Titre --}}
                <h1 class="text-2xl font-bold mb-6 text-center">
                    Conversions of Currencies
                </h1>

                {{-- Message succès --}}
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded text-center">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Formulaire de conversion --}}
                <form method="POST" action="{{ route('exchange.convert') }}" class="space-y-4 max-w-xl mx-auto">
                              @csrf 
                    {{-- De --}}
                    <div>
                        <label for="currency_from" class="block font-medium text-gray-700 mb-1">From :</label>
                        <select name="currency_from" id="currency_from" class="w-full border rounded p-2">
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}">{{ $currency->code }} - {{ $currency->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- À --}}
                    <div>
                        <label for="currency_to" class="block font-medium text-gray-700 mb-1">To :</label>
                        <select name="currency_to" id="currency_to" class="w-full border rounded p-2">
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}">{{ $currency->code }} - {{ $currency->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Montant --}}
                    <div>
                        <label for="amount" class="block font-medium text-gray-700 mb-1">Amount :</label>
                        <input type="number" name="amount" id="amount" step="0.01" min="0" required
                               class="w-full border rounded p-2" placeholder="Enter amount">
                    </div>

                    {{-- Bouton --}}
                    <div class="text-center">
                        <button type="submit" 
                                class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700 transition">
                            Convert
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
