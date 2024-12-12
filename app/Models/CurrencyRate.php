<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{

    public function base_currency()
    {
        return $this->belongsTo(Currency::class, 'base_currency_id');
    }

    public function related_currency()
    {
        return $this->belongsTo(Currency::class, 'related_currency_id');
    }

    protected $fillable = [
        'base_currency_id',
        'related_currency_id',
        'rate',
        'date',
    ];
}
