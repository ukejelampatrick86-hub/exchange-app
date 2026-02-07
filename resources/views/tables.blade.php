<table class="table">
    <thead>
        <tr>
            <th>From</th>
            <th>To</th>
            <th>Amount</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
        <tr class="odd:bg-gray-100 hover:bg-blue-100">
            <td>{{ $transaction->fromCurrency->code }}</td>
            <td>{{ $transaction->toCurrency->code }}</td>
            <td>{{ $transaction->amount_from }}</td>
            <td class="space-x-2">
                <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <a href="{{ route('transactions.destroy', $transaction->id) }}" class="btn btn-danger btn-sm">Delete</a>
                <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-secondary btn-sm">Receipt</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
