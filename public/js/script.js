window.onload = function () {

    let datepicker = document.querySelector("#date");
    let currency = document.querySelector("#currency");

    currency.addEventListener('change', function () {
        sendRequest();
    });

    flatpickr(datepicker, {
        dateFormat: "d-m-Y",
        maxDate: "today",

        onChange: function () {
            sendRequest();
        }
    });

    function sendRequest() {
        let url = '/api/currency_rates?';

        url += 'currency=' + currency.value;
        url += '&date=' + datepicker.value;

        fetch(url, {
            method: 'GET',
        })
            .then(response => response.json())
            .then(data => {
                update_currency_rates(data)
            })
    }

    function update_currency_rates(response) {
        document.getElementById('currency_rates_content').textContent = '';
        document.getElementById('pagination').textContent = '';

        let url = new URL(window.location.href);
        url.search = '';
        window.history.replaceState({}, document.title, url.toString());

        document.getElementById('currency_rates_link').classList.remove('d-none');
        document.getElementById('currency_rates_link').classList.add('block');
        let html = response.data.forEach(item => {
            let row = document.createElement('div');
            row.classList.add('flex', 'row', 'p-2');

            const codeDiv = document.createElement('div');
            codeDiv.classList.add('pr-5', 'text-center');
            codeDiv.style.width = '200px';
            codeDiv.textContent = item.related_currency_code;

            const rateDiv = document.createElement('div');
            rateDiv.classList.add('pr-5', 'text-center');
            rateDiv.style.width = '200px';
            rateDiv.textContent = item.rate;

            const dateDiv = document.createElement('div');
            dateDiv.classList.add('text-center');
            dateDiv.style.width = '200px';
            dateDiv.textContent = item.created;

            row.appendChild(codeDiv);
            row.appendChild(rateDiv);
            row.appendChild(dateDiv);

            document.getElementById('currency_rates_content').appendChild(row);

        });

        return html;
    }
};

