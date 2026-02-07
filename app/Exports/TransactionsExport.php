<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Transaction::select(
            'id',
            'amount_from',
            'amount_to',
            'created_at'
        )->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Montant source',
            'Montant converti',
            'Date'
        ];
    }
}
