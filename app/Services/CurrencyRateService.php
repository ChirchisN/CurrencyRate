<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyRateService
{

    public function fetchCurrencyRates()
    {
        $url = 'https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_EmTDUJH1HRVkUSJe4C11AQDJ0Fx5d9YVLhAjc8AO&currencies=USD%2CRON%2CRUB&base_currency=EUR';

        return HTTP::get($url);
    }

}
