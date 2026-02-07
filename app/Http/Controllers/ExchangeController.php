<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\Rate;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class ExchangeController extends Controller
{
    // Affiche le formulaire d'échange
    public function showForm()
    {
        // Récupère toutes les devises pour le formulaire
        $currencies = Currency::all();
        return view('exchange.form', compact('currencies'));
    }

    // Traite la conversion et enregistre la transaction
    public function convert(Request $request)
    {
        $request->validate([
            'currency_from' => 'required|exists:currencies,id',
            'currency_to' => 'required|exists:currencies,id',
            'amount' => 'required|numeric|min:0.01',
        ]);
     $rate = Rate::where('from_currency_id', $request->currency_from)
            ->where('to_currency_id', $request->currency_to)
            ->firstOrFail();

$amount_to = $request->amount * $rate->rate;

$transaction = Transaction::create([
    'user_id' => Auth::id(),
    'from_currency_id' => $request->currency_from,  // 👈 exactement ce nom
    'to_currency_id'   => $request->currency_to,    // 👈 exactement ce nom
    'amount_from'      => $request->amount,
    'amount_to'        => $amount_to,
    'rate'             => $rate->rate,             // 👈 doit exister
]);





        return redirect()->route('exchange.form')->with('success', 'Conversion réussie !');
    }
}
