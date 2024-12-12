<?php

namespace App\Http\Controllers;


use App\Models\CurrencyRate;
use App\Services\CurrencyService;
use Carbon\Carbon;

class HomeController extends Controller
{
    protected $currencyService;
    
    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function show()
    {
        $currencyRates = CurrencyRate::with('base_currency')
            ->with('related_currency')
            ->simplePaginate(5);

        $currencies = $this->currencyService->getAvailableCurrencies()->filter(function ($item) {
            return $item->code != env('BASE_CURRENCY');
        });

        foreach ($currencyRates as $rate) {
            $rate->created = Carbon::parse($rate->created_at)->format('d-m-Y');
        }
        return view('currency_rate', compact('currencyRates', 'currencies'));
    }

}
