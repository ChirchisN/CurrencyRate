<?php


namespace App\Services;


use App\Models\Currency;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CurrencyService
{
    public function fetchCurrencies()
    {
        $url = "https://api.freecurrencyapi.com/v1/currencies?apikey=fca_live_EmTDUJH1HRVkUSJe4C11AQDJ0Fx5d9YVLhAjc8AO&currencies=EUR%2CUSD%2CRUB%2CRON";

        return HTTP::get($url);
    }

    public function getAvailableCurrencies()
    {
        return Cache::remember('available_currencies', now()->addDay(), function () {
            return Currency::all();
        });
    }

}
