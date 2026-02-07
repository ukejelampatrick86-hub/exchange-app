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
        // Si admin, voir toutes les transactions, sinon seulement les siennes
        if(auth()->user()->is_admin) {
            $transactions = Transaction::with(['fromCurrency', 'toCurrency', 'user'])->latest()->get();
        } else {
            $transactions = Transaction::with(['fromCurrency', 'toCurrency'])
                                        ->where('user_id', auth()->id())
                                        ->latest()
                                        ->get();
        }

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Génère le PDF du reçu pour une transaction donnée
     */
    public function receipt($transaction_id)
    {
        // Récupère la transaction
        $transaction = Transaction::with(['fromCurrency', 'toCurrency', 'user'])->findOrFail($transaction_id);

        // Génère le PDF à partir de la vue Blade
        $pdf = Pdf::loadView('pdf.receipt', compact('transaction'));

        // Télécharge le PDF
        return $pdf->download('receipt_'.$transaction->id.'.pdf');

        // 💡 Option alternative pour afficher dans le navigateur :
        // return $pdf->stream('receipt_'.$transaction->id.'.pdf');
    }
    public function show(Transaction $transaction)
{
    return view('transactions.show', compact('transaction'));
}
   public function destroy($id)
{
    $transaction = Transaction::find($id);

    if ($transaction) {
        $transaction->forceDelete(); // Supprime définitivement
        return redirect()->back()->with('success', 'Transaction supprimée définitivement.');
    }

    return redirect()->back()->with('error', 'Transaction non trouvée.');
}

}

