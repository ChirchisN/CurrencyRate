<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyRateCollection;
use App\Models\CurrencyRate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CurrencyRateController extends Controller
{
    public function index(Request $request)
    {
        $currencyRatesBuilder = CurrencyRate::with('base_currency')
            ->with('related_currency');

        if ($request['currency']) {
            $currencyRatesBuilder->where('related_currency_id', $request['currency']);
        }

        if ($request['date']) {
            $date = Carbon::createFromFormat('d-m-Y', $request['date'])->toDateString();
            $currencyRatesBuilder->whereDate('created_at', $date);
        }

        return new CurrencyRateCollection($currencyRatesBuilder->get());
    }
}
