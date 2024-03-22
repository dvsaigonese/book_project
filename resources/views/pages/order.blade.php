@extends('layouts.app')

@section('title', Auth::user()->name . '\'s cart')

@section('content')
    <div class="container margin_30">
        <h1>Your Orders</h1>
        <div class="container d-flex flex-column">
            <h6>Sort by time:</h6>
            <form action="{{ route('order.timeFilter') }}" method="POST">
                @csrf
                <div class="d-flex flex-row flex align-items-center">
                    <div class="mb-3">
                        <input type="text" class="datepicker" id="form-time" name="from" value="{{ isset($from) ? $from : Carbon\Carbon::now() }}">
                    </div>
                    <div class="text-center m-1"><i class="ti-arrow-right"></i></div>
                    <div class="mb-3">
                        <input type="text" class="datepicker" id="to-time" name="to" value="{{ isset($to) ? $to : Carbon\Carbon::now() }}">
                    </div>
                    <div class="m-1"></div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            <h6>Sort by status:</h6>
            <select class="order-status form-select mb-3">
                <option value="{{ route('order.index') }}" selected>Sort</option>
                <option value="{{ route('order.statusFilter', 0) }}">Pending</option>
                <option value="{{ route('order.statusFilter', 1) }}">Processed and ready to ship</option>
                <option value="{{ route('order.statusFilter', 2) }}">Out for delivery</option>
                <option value="{{ route('order.statusFilter', 3) }}">Delivered</option>
                <option value="{{ route('order.statusFilter', 4) }}">Cancelled</option>
            </select>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">
                    ID
                </th>
                <th scope="col">
                    Time of Order
                </th>
                <th scope="col">
                    Status
                </th>
                <th scope="col">
                    Details
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <div class="order-row-item">
                    <tr class="order-item">
                        <th scope="row">
                            <strong>{{ $order->id }}</strong>
                        </th>
                        <td>
                            <strong>{{ $order->created_at }}</strong>
                        </td>
                        <td class="order-status-item">
                            @if($order->order_status == 0)
                                <strong data-id="0">Pending</strong>
                            @elseif($order->order_status == 1)
                                <strong data-id="1">Processed and ready to ship</strong>
                            @elseif($order->order_status == 2)
                                <strong data-id="2">Out for delivery</strong>
                            @elseif($order->order_status == 3)
                                <strong data-id="3">Delivered</strong>
                            @elseif($order->order_status == 4)
                                <strong data-id="4">Cancelled</strong>
                            @else
                                <strong data-id="5">Unknown</strong>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-outline-dark order-ìnfo-btn"><i class="ti-info"></i></button>
                        </td>
                    </tr>
                    <tr class="order-info">
                        <td colspan="4" class="fw-bold">
                            Total Price: <strong>{{ $order->total_price }}</strong><br>
                            Recipient Name: <strong>{{ $order->order_name }}</strong><br>
                            Recipient Phone: <strong>{{ $order->order_phone }}</strong><br>
                            Recipient Address: <strong>{{ $order->order_address }}</strong><br>
                            @if($order->payment_status == 0)
                                Payment Status: <strong>Unpaid</strong><br>
                            @elseif($order->payment_status == 1)
                                Payment Status: <strong>Paid</strong><br>
                            @else
                                Payment Status: <strong>Unknown</strong><br>
                            @endif
                        </td>
                    </tr>
                </div>
            @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
    @if(session('error'))
        @php
            $message = session('error');
        @endphp
        <x-toast-message status="error" :message="$message"/>
    @endif
    @if(session('warning'))
        @php
            $message = session('warning');
        @endphp
        <x-toast-message status="error" :message="$message"/>
    @endif
    @if(session('success'))
        @php
            $message = session('success');
        @endphp
        <x-toast-message status="success" :message="$message"/>
    @endif
@endsection

@section('scripts')
    <script>
        flatpickr(".datepicker", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });

        const orderInfoBtn = document.querySelectorAll('.order-ìnfo-btn');
        const orderInfo = document.querySelectorAll('.order-info');
        orderInfo.forEach(element => {
            element.style.display = 'none';
        })
        orderInfoBtn.forEach(function (element, index) {
            element.addEventListener('click', () => {
                if (orderInfo[index].style.display === 'none') {
                    console.log(orderInfo[index])
                    orderInfo[index].style.display = 'table-cell';
                } else {
                    orderInfo[index].style.display = 'none';
                }
            })
        })

        const orderStatusSelect = document.querySelector('.order-status');
        orderStatusSelect.value = window.location;
        orderStatusSelect.addEventListener('change', function () {
            window.location.href = this.value;

        })
    </script>
@endsection

@section('styles')

@endsection
