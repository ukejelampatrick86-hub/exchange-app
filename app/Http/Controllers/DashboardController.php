<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
    
    // Transactions récentes visibles (non soft deleted)
    $transactions = Transaction::withoutTrashed()->latest()->take(10)->get();

    // Total des transactions visibles
    $totalAmount = Transaction::withoutTrashed()->sum('amount_to'); // ou 'amount_from' selon ton choix

    // Dernière transaction visible
    $lastTransaction = Transaction::withoutTrashed()->latest()->first();

    // Total Transactions
    $totalTransactions = Transaction::withoutTrashed()->count();

    return view('dashboard', compact(
        'transactions',
        'totalAmount',
        'lastTransaction',
        'totalTransactions'
    ));
}

    }
  


