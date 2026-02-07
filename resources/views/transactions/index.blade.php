<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Transactions
            </h2>

            <!-- Boutons export -->
            <div class="flex gap-2">
                <a href="{{ url('/export/transactions/excel') }}"
                   class="bg-green-600 hover:bg-green-700 text-black px-4 py-2 rounded">
                    📊 Export Excel
                </a>
            </div>
        </div>
    </x-slot>

    {{-- Contenu plein écran --}}
    <div class="py-6 px-6">
        <div class="mx-auto max-w-screen-2xl">

            {{-- Card --}}
            <div class="bg-white shadow rounded-lg overflow-x-auto">

                {{-- Tableau large --}}
                <table class="min-w-full w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">ID</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">From</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">To</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Amount</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Date</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse($transactions as $transaction)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-center whitespace-nowrap">
                                    {{ $transaction->id }}
                                </td>

                                <td class="px-4 py-3 text-center whitespace-nowrap">
                                    {{ $transaction->fromCurrency->code }}
                                </td>

                                <td class="px-4 py-3 text-center whitespace-nowrap">
                                    {{ $transaction->toCurrency->code }}
                                </td>

                                <td class="px-4 py-3 text-center whitespace-nowrap">
                                    {{ $transaction->amount_from }} → {{ $transaction->amount_to }}
                                </td>

                                <td class="px-4 py-3 text-center whitespace-nowrap">
                                    {{ $transaction->created_at->format('d/m/Y H:i') }}
                                </td>

                                <td class="px-4 py-3 text-center whitespace-nowrap flex justify-center gap-2">
                                    <!-- Bouton Receipt -->
                                    <a href="{{ route('transactions.show', $transaction->id) }}"
                                       class="inline-flex items-center gap-2
                                              bg-blue-800 text-black
                                              px-3 py-1.5 rounded
                                              text-sm font-medium
                                              hover:bg-white
                                              transition">
                                        📄 Receipt
                                    </a>

                                    <!-- Bouton Supprimer -->
                                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette transaction ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 bg-red-600 text-white rounded hover:bg-red-500 text-sm font-medium">
                                             Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                    No transactions found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
