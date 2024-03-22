@extends('admin.app')

@section('title', 'Admin Satistics')

@section('content')
    <div class="m-5">
        @isset($toast)
            <x-toast-message :status="$toast['status']" :message="$toast['message']"/>
        @endisset
        <h4>Revenue Satistics</h4>
        <select id="chon-lua" class="form-select">
            <option value="#">Select Satistical Method</option>
            <option value="0">This Year By Month</option>
            <option value="1">This Year By Quarter</option>
            <option value="2">This Month By Day</option>
            <option value="3">This Day By Hour</option>
            <option value="4">All Time By Year</option>
        </select>
        <div class="mt-3">
            <h5>Or custom time and method to Satistical</h5>
            <div class="d-flex flex-row flex align-items-center">
                <div class="mb-3">
                    <input type="text" class="datepicker" id="form-time" name="from"
                           value="{{ Carbon\Carbon::now() }}">
                </div>
                <div class="text-center mb-3 "><i class="ti-arrow-right"></i></div>
                <div class="mb-3">
                    <input type="text" class="datepicker" id="to-time" name="to"
                           value="{{ Carbon\Carbon::now() }}">
                </div>
                <div class="mb-3 ml-3">
                    <select id="chon-lua-2" class="form-select">
                        <option value="#">Select Method</option>
                        <option value="0">By Month</option>
                        <option value="1">By Day</option>
                        <option value="2">By Hour</option>
                    </select>
                </div>
                <div class="mb-3 ml-3">
                    <button id="filter-submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </div>

        <div id="chart-container" class="m-5">
            <canvas id="myChart"></canvas>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        flatpickr(".datepicker", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });

        const chartContainer = document.getElementById('chart-container');
        const select = document.getElementById('chon-lua');

        select.addEventListener('change', function () {
            document.querySelector("#chart-container").innerHTML = '<canvas id="myChart"></canvas>';
            var ctx = document.getElementById("myChart");

            var url = window.location;
            axios.get(url + `/${this.value}`)
                .then((response) => {
                    console.log(response.data)
                    var labels = response.data.map((label) => label.x);
                    var data = response.data.map((data) => data.y);

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Revenue',
                                data: data,
                                fill: false,
                                radius: 5,
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: false
                                }
                            }
                        }
                    });
                })
        })

        const filterSubmitBtn = document.getElementById('filter-submit');
        filterSubmitBtn.addEventListener('click', function () {
            var from = document.getElementById('form-time').value;
            var to = document.getElementById('to-time').value;
            var method = document.getElementById('chon-lua-2').value;

            if (from && to && method) {
                document.querySelector("#chart-container").innerHTML = '<canvas id="myChart"></canvas>';
                var ctx = document.getElementById("myChart");

                var url = window.location;
                axios.get(url + `-time/${method}`, {
                    params: {
                        from: from,
                        to: to,
                    }
                })
                    .then((response) => {
                        console.log(response.data)
                        var labels = response.data.map((label) => label.x);
                        var data = response.data.map((data) => data.y);

                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Revenue',
                                    data: data,
                                    fill: false,
                                    radius: 5,
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: false
                                    }
                                }
                            }
                        });
                    }).catch((error) => {
                        console.log(error)
                    })
            } else {
                alert('Please select method and time.')
            }
        })


    </script>

@endsection
