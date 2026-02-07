<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800">
                Dashboard
            </h2>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

        <!-- Total Transactions -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-sm font-semibold text-gray-500 uppercase">Total Transactions</h3>
            <p class="mt-2 text-2xl font-bold text-gray-800">{{ $totalTransactions ?? '-' }}</p>
        </div>

        <!-- Total Amount -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-sm font-semibold text-gray-500 uppercase">Total Amount</h3>
            <p class="mt-2 text-2xl font-bold text-gray-800">
                {{ $totalAmount }} {{ $lastTransaction?->fromCurrency->code ?? '' }}
            </p>
        </div>

        <!-- Last Transaction -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-sm font-semibold text-gray-500 uppercase">Last Transaction</h3>
            <p class="mt-2 text-xl text-gray-800">
                {{ $lastTransaction?->amount_to ?? '-' }} {{ $lastTransaction?->toCurrency->code ?? '' }}
            </p>
        </div>

        <!-- Last Rate -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-sm font-semibold text-gray-500 uppercase">Last Rate</h3>
            <p class="mt-2 text-xl text-gray-800">{{ $lastTransaction?->rate ?? '-' }}</p>
        </div>
    </div>

    <!-- Recent Transactions Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">From</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">To</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($transactions as $transaction)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $transaction->id ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $transaction->fromCurrency->code ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $transaction->toCurrency->code ?? '-' }}</td>
                        <td class="px-4 py-2">
                            {{ $transaction->amount_from ?? '-' }} {{ $transaction->fromCurrency->code ?? '' }}
                            =>
                            {{ $transaction->amount_to ?? '-' }} {{ $transaction->toCurrency->code ?? '' }}
                        </td>
                        <td class="px-4 py-2">{{ $transaction->created_at?->format('d/m/Y H:i') ?? '-' }}</td>
                        <td class="px-4 py-2 space-x-1">
                            <a href="{{ route('transactions.show', $transaction->id) }}"
                               class="inline-flex items-center gap-1 bg-gray-600 text-black px-3 py-1 rounded text-sm hover:bg-gray-700 transition">
                               🔍 Details
                            </a>
                            <a href="{{ route('transactions.receipt', $transaction->id) }}"
                               class="inline-flex items-center gap-1 bg-black text-black px-3 py-1 rounded text-sm hover:bg-gray-800 transition">
                               📄 Receipt
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                            No transactions found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
