<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CurrencyRateCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     */
    public function toArray(Request $request)
    {
        return $this->collection->transform(function ($currencyRate) {
            return [
                'id' => $currencyRate->id,
                'base_currency_code' => $currencyRate->base_currency->code,
                'related_currency_code' => $currencyRate->related_currency->code,
                'rate' => $currencyRate->rate,
                'created' => Carbon::parse($currencyRate->created_at)->format('d-m-Y'),
            ];
        });
    }
}
