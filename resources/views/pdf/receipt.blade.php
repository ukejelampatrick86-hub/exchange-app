<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Receipt of transaction #{{ $transaction->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #333; }
        .container { width: 100%; padding: 20px; }
        h1 { text-align: center; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .footer { text-align: center; margin-top: 40px; font-size: 12px; color: #555; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Receipt of transaction</h1>

        <table>
            <tr>
                <th>ID Transaction</th>
                <td>{{ $transaction->id }}</td>
            </tr>
            <tr>
                <th>User</th>
                <td>{{ $transaction->user->name }} ({{ $transaction->user->email }})</td>
            </tr>
            <tr>
                <th>From</th>
                <td>{{ $transaction->amount_from }} {{ $transaction->fromCurrency->code }}</td>
            </tr>
            <tr>
                <th>To</th>
                <td>{{ $transaction->amount_to }} {{ $transaction->toCurrency->code }}</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        </table>

        <div class="footer">
            Thank you for your trust.<br>
            &copy; {{ date('Y') }} Exchange App
        </div>
    </div>
</body>
</html>
