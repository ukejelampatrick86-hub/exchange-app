<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800">
            Transaction Details
        </h2>
    </x-slot>

    <div class="bg-white shadow rounded-lg p-6 space-y-4">

        <p><strong>From:</strong> {{ $transaction->fromCurrency->code }}</p>
        <p><strong>To:</strong> {{ $transaction->toCurrency->code }}</p>
        <p><strong>Amount:</strong> {{ $transaction->amount_from }}</p>
        <p><strong>Converted Amount:</strong> {{ $transaction->amount_to }}</p>
        <p><strong>Exchange Rate:</strong> {{ $transaction->rate }}</p>
        <p><strong>Date:</strong> {{ $transaction->created_at->format('d/m/Y H:i') }}</p>

        <div class="flex space-x-2 mt-4">
            <a href="{{ route('transactions.index') }}"
               class="px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700 transition">
               Back to Transactions
            </a>
            <a href="{{ route('transactions.receipt', $transaction->id) }}"
               class="px-4 py-2 bg-black text-black rounded hover:bg-gray-800 transition">
               📄 Download Receipt
            </a>
        </div>
    </div>
</x-app-layout>
