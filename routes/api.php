<?php

use App\Http\Controllers\Api\V1\CurrencyRateController;
use Illuminate\Support\Facades\Route;


Route::resource('currency_rates', CurrencyRateController::class);

