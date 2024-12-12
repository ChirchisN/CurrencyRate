<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Currency rate</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
<div class="container">
    @auth()
        <nav class="flex flex-row justify-center mt-5 mb-5 ">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-500 hover:underline text-xl">Logout</button>
            </form>
        </nav>

        <div class="flex flex-col items-center mt-5">
            <h1 class="text-2xl">Hello <span class="text-blue-500"> {{\Illuminate\Support\Facades\Auth::user()->name}}</span>, there are the EURO rate in relation to other currencies</h1>
            <div class="mt-3 mb-3 flex flex-row">
                <div class="flex flex-col justify-between mr-5 mb-5">
                    <p class="mb-3">Filter by currency: </p>
                    <select id="currency" class="mr-3 border p-2">
                        <option value="" selected>Select currency</option>
                        @foreach($currencies as $currency)
                            <option value="{{$currency->id}}">{{$currency->code}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <p class="mb-3">Filter by date: </p>
                    <input type="text" id="date" class="flatpickr border p-2" name="calendar"
                           placeholder="Select date">
                </div>
            </div>
            <div>
                <a href="/" id="currency_rates_link" class="hidden mt-3 mb-5">Show all currency rates</a>
            </div>
            <div class="flex flex-row font-bold text-center pr-5 mr-3 text-blue-500">
                <div style="width: 200px"> Related currency</div>
                <div style="width: 200px"> Rate</div>
                <div style="width: 200px"> Date</div>
            </div>

            <div id="currency_rates_content" class="text-center">
                @foreach($currencyRates as $rate)
                    <div class="flex flex-row p-2 ">
                        <div class="pr-5 text-center"
                             style="width: 200px"> {{$rate->related_currency->code}}
                        </div>
                        <div class="pr-5 text-center"
                             style="width: 200px"> {{number_format($rate->rate, 4)}}
                        </div>
                        <div class="text-center" style="width: 200px"> {{$rate->created}}
                        </div>
                    </div>
                @endforeach
            </div>

            <div id="pagination" class="mt-4">{{ $currencyRates->links() }}</div>

        </div>

        <script src="{{ asset('js/script.js') }}"></script>
    @else
        <div class="text-center mt-8">
            <div class="mb-5"><h1 class="text-3xl">Currency Rates</h1></div>
            <div> If you want to see currency rates info you need to
                <a href="{{ route('login')}}"><span class="text-lg text-blue-500 hover:underline"> Login </span></a> or
                <a href="{{route('register')}}"><span class="text-lg text-blue-500 hover:underline">Register</span></a>
            </div>
        </div>

    @endauth

</div>

</body>
</html>




