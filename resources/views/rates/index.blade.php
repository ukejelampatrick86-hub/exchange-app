<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Exchange Rate
            </h2>
        </div>
    </x-slot>
                          
            {{-- New Rate --}}
          <a href="{{ route('rates.create') }}"
             class="inline-flex items-center gap-3
                  bg-green-600 text-black
                    px-6 py-3 rounded
                    text-lg font-semibold
                  hover:bg-green-700
                    transition">
            <span>New Rate</span>
           </a>

    {{-- Contenu plein écran --}}
    <div class="py-6 px-6">
        <div class="mx-auto max-w-screen-2xl">

            {{-- Card --}}
            <div class="bg-white shadow rounded-lg overflow-x-auto p-6">

                {{-- Tableau large --}}
                <table class="min-w-full w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">From</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">To</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Rate</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse($rates as $rate)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-center whitespace-nowrap">{{ $rate->fromCurrency->code ?? '-' }}</td>
                                <td class="px-4 py-3 text-center whitespace-nowrap">{{ $rate->toCurrency->code ?? '-' }}</td>
                                <td class="px-4 py-3 text-center whitespace-nowrap">{{ $rate->rate ?? '-' }}</td>
                                <td class="px-4 py-3 text-center whitespace-nowrap">
                                    <div class="flex justify-center gap-2">

                                        {{-- Edit --}}
                                        <a href="{{ route('rates.edit', $rate->id) }}"
                                           class="inline-flex items-center gap-1
                                                  bg-blue-800 text-black
                                                  px-3 py-1.5 rounded
                                                  text-sm font-medium
                                                  hover:bg-blue-600
                                                  transition">
                                             <span class="text-black">Edit</span>
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('rates.destroy', $rate->id) }}"
                                              method="POST"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Supprimer ce taux ?')"
                                                    class="inline-flex items-center gap-1
                                                           bg-red-600 text-white
                                                           px-3 py-1.5 rounded
                                                           text-sm font-medium
                                                           hover:bg-red-500
                                                           transition">
                                                 <span class="text-white">Delete</span>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                    Aucun taux trouvé.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
