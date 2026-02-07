<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($rate) ? 'Edit Rate' : 'Add Rate' }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ isset($rate) ? route('rates.update', $rate) : route('rates.store') }}">
                    @csrf
                    @if(isset($rate))
                        @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">De (Currency In):</label>
                        <select name="from_currency_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}" 
                                    {{ (old('from_currency_id', $rate->from_currency_id ?? '') == $currency->id) ? 'selected' : '' }}>
                                    {{ $currency->code }} - {{ $currency->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Vers (Currency Out):</label>
                        <select name="to_currency_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}" 
                                    {{ (old('to_currency_id', $rate->to_currency_id ?? '') == $currency->id) ? 'selected' : '' }}>
                                    {{ $currency->code }} - {{ $currency->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Rate:</label>
                        <input type="number" step="0.0001" name="rate" value="{{ old('rate', $rate->rate ?? '') }}" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <button type="submit" class="px-4 py-2 bg-green-600 text-black rounded hover:bg-green-700">
                        Submit
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
