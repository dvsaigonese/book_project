@extends('admin.app')

@section('title', 'Admin Orders')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @isset($toast)
        <x-toast-message :status="$toast['status']" :message="$toast['message']"/>
    @endisset
    @livewire('order-table')
@endsection

@section('scripts')
    <script>
        const orderStatus = document.querySelectorAll('.order-status');

        orderStatus.forEach(function (element, index) {
            element.addEventListener('change', function (event) {
                let id = element.dataset.id;
                const URL = location.protocol + '//' + location.host + '/admin/order/order_status/' + id;
                axios.put(URL, {
                    order_status: element.value,
                }).then(function (response) {
                    console.log(response.data);
                })
            });
        })

        const paymentStatus = document.querySelectorAll('.payment-status');

        paymentStatus.forEach(function (element, index) {
            element.addEventListener('change', function (event) {
                let id = element.dataset.id;
                let changeStatus = element.checked ? 1 : 0;
                const URL = location.protocol + '//' + location.host + '/admin/order/payment_status/' + id;
                axios.put(URL, {
                    payment_status: changeStatus,
                }).then(function (response) {
                    console.log(response.data);
                })
            });
        })

    </script>
@endsection
