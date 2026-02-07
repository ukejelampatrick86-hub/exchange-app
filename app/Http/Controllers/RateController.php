<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\Currency;
use Illuminate\Http\Request;

class RateController extends Controller
{
    // Supprime complètement le constructeur pour l'instant
    // public function __construct()
    // {
    //     $this->middleware(['auth','admin']);
    // }

    public function index()
    {
        $rates = Rate::with(['fromCurrency','toCurrency'])->get();
        return view('rates.index', compact('rates'));
    }

    public function create()
    {
        $currencies = Currency::all();
        return view('rates.create', compact('currencies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'from_currency_id' => 'required|exists:currencies,id',
            'to_currency_id' => 'required|exists:currencies,id',
            'rate' => 'required|numeric|min:0',
        ]);

        Rate::create($request->all());

        return redirect()->route('rates.index');
    }

    public function edit(Rate $rate)
    {
        $currencies = Currency::all();
        return view('rates.edit', compact('rate','currencies'));
    }

    public function update(Request $request, Rate $rate)
    {
        $request->validate([
            'from_currency_id' => 'required|exists:currencies,id',
            'to_currency_id' => 'required|exists:currencies,id',
            'rate' => 'required|numeric|min:0',
        ]);

        $rate->update($request->all());

        return redirect()->route('rates.index');
    }

    public function destroy(Rate $rate)
    {
        $rate->delete();
        return redirect()->route('rates.index');
    }
}
