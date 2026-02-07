<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;

// Page d'accueil (ex: dashboard)
Route::get('/', function () {
    return view('welcome'); // ou dashboard
})->middleware('auth');

// 🔒 Routes accessibles seulement aux utilisateurs connectés
Route::middleware(['auth'])->group(function () {

    // 💱 Conversion
    Route::get('/exchange', [ExchangeController::class, 'showForm'])->name('exchange.form'); 
    Route::post('/exchange', [ExchangeController::class, 'convert'])->name('exchange.convert');

    // Currencies et Rates accessibles à tous les utilisateurs connectés
    Route::resource('currencies', CurrencyController::class);
    Route::resource('rates', RateController::class);

    // Transactions
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{transaction}/receipt', [TransactionController::class, 'receipt'])
         ->name('transactions.receipt');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');
Route::get('/colors', function () {
    return view('colors');
});
Route::get('/typography', function () {
    return view('typography');
});

Route::get('/export/transactions/excel', function () {
    return Excel::download(new TransactionsExport, 'transactions.xlsx');
});

Route::get('/export/transactions/csv', function () {
    return Excel::download(
        new TransactionsExport,
        'transactions.csv',
        \Maatwebsite\Excel\Excel::CSV
    );
});

// Route pour supprimer une transaction spécifique
Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])
     ->name('transactions.destroy');




// Auth routes (login, register, logout)
require __DIR__.'/auth.php';
