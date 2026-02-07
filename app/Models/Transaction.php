<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Currency;

class Transaction extends Model
{
    use SoftDeletes; // ← ajoute ça
    protected $fillable = [
        'user_id',
        'from_currency_id',
        'to_currency_id',
        'amount_from',
        'amount_to',
        'rate',
    ];
    protected $dates = ['deleted_at']; // optionnel si Laravel >= 7

    public function fromCurrency()
    {
        return $this->belongsTo(Currency::class, 'from_currency_id');
    }

    public function toCurrency()
    {
        return $this->belongsTo(Currency::class, 'to_currency_id');
    }

    /**
     * Relation vers l'utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
