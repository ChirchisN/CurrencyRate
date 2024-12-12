<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\CurrencyRate;
use App\Services\CurrencyRateService;
use App\Services\CurrencyService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;


class SyncCurrencyRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync-currency-rates:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add currency rates against the euro';

    /**
     * Execute the console command.
     */

    protected $currencyRateService;
    protected $currencyService;

    public function __construct(CurrencyRateService $currencyRateService, CurrencyService $currencyService)
    {
        parent::__construct();
        $this->currencyRateService = $currencyRateService;
        $this->currencyService = $currencyService;
    }

    public function handle()
    {
        $baseCurency = Currency::where('code', 'EUR')->first();

        $response = $this->currencyRateService->fetchCurrencyRates();

        if ($response->failed()) {
            Log::error($response);
            return;
        }

        $currencies = $this->currencyService->getAvailableCurrencies();

        foreach ($response->json()['data'] as $currency => $rate) {
            $related_currency = $currencies->firstWhere('code', $currency);

            if ($related_currency) {
                CurrencyRate::create([
                    'base_currency_id' => $baseCurency->id,
                    'related_currency_id' => $related_currency->id,
                    'rate'=> $rate,
                    'date'=>now(),
                ]);

            }
        }
    }
}
