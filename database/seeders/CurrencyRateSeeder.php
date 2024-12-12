<?php

namespace Database\Seeders;

use App\Models\CurrencyRate;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CurrencyRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencyRates = [
            [
                'base_currency_id' => 1,
                'related_currency_id' => 2,
                'rate' => 1.1158810636,
                'created_at' => Carbon::now()->subDay(3),
            ],
            [
                'base_currency_id' => 1,
                'related_currency_id' => 3,
                'rate' => 5.01725378304,
                'created_at' => Carbon::now()->subDay(3),
            ],
            [
                'base_currency_id' => 1,
                'related_currency_id' => 4,
                'rate' => 103.9964419514,
                'created_at' => Carbon::now()->subDay(3),
            ],
            [
                'base_currency_id' => 1,
                'related_currency_id' => 2,
                'rate' => 1.0558210636,
                'created_at' => Carbon::now()->subDay(2),
            ],
            [
                'base_currency_id' => 1,
                'related_currency_id' => 3,
                'rate' => 4.9725378304,
                'created_at' => Carbon::now()->subDay(2),
            ],
            [
                'base_currency_id' => 1,
                'related_currency_id' => 4,
                'rate' => 105.0264419514,
                'created_at' => Carbon::now()->subDay(2),
            ],
            [
                'base_currency_id' => 1,
                'related_currency_id' => 2,
                'rate' => 1.0858810636,
                'created_at' => Carbon::now()->subDay(1),
            ],
            [
                'base_currency_id' => 1,
                'related_currency_id' => 3,
                'rate' => 4.99725378304,
                'created_at' => Carbon::now()->subDay(1),
            ],
            [
                'base_currency_id' => 1,
                'related_currency_id' => 4,
                'rate' => 106.5264419514,
                'created_at' => Carbon::now()->subDay(1),
            ],
            [
                'base_currency_id' => 1,
                'related_currency_id' => 2,
                'rate' => 1.1058810636,
            ],
            [
                'base_currency_id' => 1,
                'related_currency_id' => 3,
                'rate' => 5.00725378304,
            ],
            [
                'base_currency_id' => 1,
                'related_currency_id' => 4,
                'rate' => 104.7264419514,
            ]
        ];

        foreach ($currencyRates as $currencyRate) {
            CurrencyRate::create($currencyRate);
        }
    }
}
