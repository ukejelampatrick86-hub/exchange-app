<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    /**
     * Affiche la liste des transactions (admin ou utilisateur)
     */
    public function index()
    {
        if (auth()->user()->is_admin) {
            $transactions = Transaction::with(['fromCurrency', 'toCurrency', 'user'])
                ->latest()
                ->get();
        } else {
            $transactions = Transaction::with(['fromCurrency', 'toCurrency'])
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
        }

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Enregistre une nouvelle transaction
     */
    public function store(Request $request)
    {
        $request->validate([
            'from_currency_id' => 'required|exists:currencies,id',
            'to_currency_id'   => 'required|exists:currencies,id',
            'amount_from'      => 'required|numeric|min:0.01',
            'amount_to'        => 'required|numeric|min:0.01',
            'rate'             => 'required|numeric|min:0',
        ]);

        Transaction::create([
            'user_id'          => auth()->id(),
            'from_currency_id' => $request->from_currency_id,
            'to_currency_id'   => $request->to_currency_id,
            'amount_from'      => $request->amount_from,
            'amount_to'        => $request->amount_to,
            'rate'             => $request->rate,
        ]);

        return redirect()->back()->with('success', 'Transaction créée avec succès.');
    }

    /**
     * Affiche une transaction
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Met à jour une transaction
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'from_currency_id' => 'required|exists:currencies,id',
            'to_currency_id'   => 'required|exists:currencies,id',
            'amount_from'      => 'required|numeric|min:0.01',
            'amount_to'        => 'required|numeric|min:0.01',
            'rate'             => 'required|numeric|min:0',
        ]);

        $transaction->update([
            'from_currency_id' => $request->from_currency_id,
            'to_currency_id'   => $request->to_currency_id,
            'amount_from'      => $request->amount_from,
            'amount_to'        => $request->amount_to,
            'rate'             => $request->rate,
        ]);

        return redirect()->back()->with('success', 'Transaction mise à jour avec succès.');
    }

    /**
     * Supprime définitivement une transaction
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaction non trouvée.');
        }

        $transaction->forceDelete();

        return redirect()->back()->with('success', 'Transaction supprimée définitivement.');
    }

    /**
     * Génère le reçu PDF d'une transaction
     */
    public function receipt($transaction_id)
    {
        $transaction = Transaction::with(['fromCurrency', 'toCurrency', 'user'])
            ->findOrFail($transaction_id);

        $pdf = Pdf::loadView('pdf.receipt', compact('transaction'));

        return $pdf->download('receipt_' . $transaction->id . '.pdf');
        // ou : return $pdf->stream('receipt_'.$transaction->id.'.pdf');
    }
}
