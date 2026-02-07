<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($currency) ? 'Edit Currency' : 'Add Currency' }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ isset($currency) ? route('currencies.update', $currency) : route('currencies.store') }}">
                    @csrf
                    @if(isset($currency))
                        @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Code:</label>
                        <input type="text" name="code" value="{{ old('code', $currency->code ?? '') }}" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Nom:</label>
                        <input type="text" name="name" value="{{ old('name', $currency->name ?? '') }}" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Type:</label>
                        <select name="type" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="normal" {{ (old('type', $currency->type ?? '') == 'normal') ? 'selected' : '' }}>Normal</option>
                            <option value="special" {{ (old('type', $currency->type ?? '') == 'special') ? 'selected' : '' }}>Spécial</option>
                        </select>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-green-600 text-black rounded hover:bg-green-700">
                        Submit
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
