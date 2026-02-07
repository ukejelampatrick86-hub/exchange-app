<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

// IMPORTANT : hérite bien de Controller de Laravel
class CurrencyController extends Controller
{
    // Supprime complètement le constructeur pour l'instant
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $currencies = Currency::all();
        return view('currencies.index', compact('currencies'));
    }

    public function create()
    {
        return view('currencies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'type' => 'required|in:normal,special',
        ]);

        Currency::create($request->all());

        return redirect()->route('currencies.index');
    }

    public function edit(Currency $currency)
    {
        return view('currencies.edit', compact('currency'));
    }

    public function update(Request $request, Currency $currency)
    {
        $request->validate([
            'code' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'type' => 'required|in:normal,special',
        ]);

        $currency->update($request->all());

        return redirect()->route('currencies.index');
    }

    public function destroy(Currency $currency)
    {
        $currency->delete();
        return redirect()->route('currencies.index');
    }
}
