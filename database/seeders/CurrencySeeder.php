<?php

namespace Database\Seeders;

use App\Services\CurrencyService;
use Illuminate\Database\Seeder;
use App\Models\Currency;
use Illuminate\Support\Facades\Cache;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function run(): void
    {
        $response = $this->currencyService->fetchCurrencies();

        foreach ($response->json()['data'] as $key => $value) {
            if (!Currency::where('code', $value['code'])->exists()) {
                Currency::create([
                    'code' => $value['code'],
                    'name' => $value['name'],
                    'symbol' => $value['symbol']
                ]);
            }
        }

        Cache::forget('available_currencies');
    }
}
