@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="container margin_30">
        <div class="page_header">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Category</a></li>
                    <li>Page active</li>
                </ul>
            </div>
            <h1>Checkout</h1>

        </div>
        <!-- /page_header -->
        <form method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="step first">
                        <h3>1. User Info and Billing address</h3>
                        <div class="tab-content checkout">
                            <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1">
                                <div class="form-group">
                                    <input type="text" name="order_name" class="form-control" placeholder="Name"
                                           required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="order_phone" class="form-control" placeholder="Telephone"
                                           required>
                                </div>
                                <h6>Address</h6>
                                <div class="col-md-12 form-group" id="checkout-province">
                                    <select class="wide add_bottom_15 form-select" required>
                                        <option value="" selected>Province</option>
                                    </select>
                                </div>
                                <div class="col-md-12 form-group" id="checkout-district">
                                    <select class="wide add_bottom_15 form-select" required>
                                        <option value="" selected>District</option>
                                    </select>
                                </div>
                                <div class="col-md-12 form-group" id="checkout-ward">
                                    <select class="wide add_bottom_15 form-select" required>
                                        <option value="" selected>Ward</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input id="address-details" type="text" class="form-control"
                                           placeholder="Address Details" required>
                                </div>
                                <input id="order-address" class="d-none" name="order_address">
                                <!-- /row -->
                            </div>
                            <!-- /tab_1 -->
                        </div>
                    </div>
                    <!-- /step -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="step last">
                        <h3>2. Order Summary</h3>
                        <h6 class="pb-2">Shipping Method</h6>
                        <ul>
                            <li>
                                <label class="container_radio">Standard shipping<a href="#0" class="info"
                                                                                   data-bs-toggle="modal"
                                                                                   data-bs-target="#payments_method"></a>
                                    <input type="radio" name="shipping" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_radio">Express shipping<a href="#0" class="info"
                                                                                  data-bs-toggle="modal"
                                                                                  data-bs-target="#payments_method"></a>
                                    <input type="radio" name="shipping">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                        </ul>
                        <div class="box_general summary">
                            <ul>
                                @foreach($carts as $cart)
                                    <li class="clearfix"><em>{{ $cart->quantity }}x {{ $cart->name }}</em>
                                        <span>{{ $cart->book_price }}</span></li>
                                @endforeach
                            </ul>
                            @php
                                $total = 0;
                                foreach ($carts as $cart) {
                                    $total += $cart->quantity * $cart->book_price;
                                }
                            @endphp
                            <ul>
                                <li class="clearfix"><em><strong>Subtotal</strong></em> <span>{{ $total }}</span>

                                </li>
                                <li class="clearfix"><em><strong>Shipping</strong></em> <span
                                        id="shipping-cost">0</span>
                                    <input value="0" class="d-none" name="shipping_fee" id="shipping-fee">
                                </li>

                            </ul>
                            <div class="total clearfix">TOTAL <span id="total-cost">{{ $total }}</span></div>
                            <input value="" class="d-none" name="subtotal_price" id="subtotal-price">
                            <input value="" class="d-none" name="total_price" id="total-price">
                        </div>
                        <!-- /box_general -->
                    </div>
                    <!-- /step -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="step middle payments">
                        <h3>3. Confirm and Payment</h3>
                        <ul>
                            <li>
                                <button formaction="{{ route('vnpay_payment') }}" class="btn btn-primary w-100"
                                        name="redirect" type="submit">VN PAY
                                </button>
                            </li>
                            <li>
                                <button formaction="{{ route('cash_on_delivery') }}" class="btn btn-primary w-100"
                                        type="submit">Cash on delivery
                                </button>
                            </li>
                        </ul>
                    </div>
                    <!-- /step -->

                </div>

            </div>
        </form>
        <!-- /row -->
    </div>
    <!-- /container -->
@endsection

@section('scripts')
    <script>
        const province = document.querySelector('#checkout-province');
        const district = document.querySelector('#checkout-district');
        const ward = document.querySelector('#checkout-ward');
        const shippingCost = document.querySelector('#shipping-cost');
        const totalCost = document.querySelector('#total-cost');
        const shipMethod = document.querySelectorAll("input[name='shipping']");
        const addressDetails = document.querySelector('#address-details');
        const orderAddress = document.querySelector('#order-address');
        const shippingFee = document.querySelector('#shipping-fee');
        const totalPrice = document.querySelector('#total-price');
        const subtotalPrice = document.querySelector('#subtotal-price');

        axios.get('{{ route('ghn.province') }}')
            .then(function (response) {
                response.data.data.forEach((element) => {
                    province.firstElementChild.innerHTML += `<option value="${element.ProvinceID}" data-province="${element.ProvinceName}">${element.ProvinceName}</option>`;
                })
            })
            .catch((e) => {
                console.log(e)
            })

        province.firstElementChild.addEventListener('change', function (e) {
            district.firstElementChild.innerHTML = '<option value="" selected>District</option>';
            var provinceId = parseInt(e.target.value);
            var url = location.protocol + '//' + location.host + '/district';
            axios.get(`${url}/${provinceId}`)
                .then(function (response) {
                    response.data.data.forEach((element) => {
                        district.firstElementChild.innerHTML += `<option value="${element.DistrictID}" data-district="${element.DistrictName}">${element.DistrictName}</option>`;
                    })
                })
                .catch((e) => {
                    console.log(e)
                })
        })

        district.firstElementChild.addEventListener('change', function (e) {
            ward.firstElementChild.innerHTML = '<option value="" selected>Ward</option>';
            let districtId = parseInt(e.target.value);
            let url = location.protocol + '//' + location.host + '/ward';
            axios.get(`${url}/${districtId}`)
                .then(function (response) {
                    response.data.data.forEach((element) => {
                        ward.firstElementChild.innerHTML += `<option value="${element.WardCode}" data-ward="${element.WardName}">${element.WardName}</option>`;
                    })
                })
                .catch((e) => {
                    console.log(e)
                })
        })

        ward.firstElementChild.addEventListener('change', function (e) {
            getShipCost();
            setAddress();
        })

        shipMethod.forEach((input) => {
            input.addEventListener('change', getShipCost);
        });

        function getShipCost() {
            let districtId = district.firstElementChild.value;
            let wardCode = ward.firstElementChild.value;
            let shipping = shipMethod[0].checked ? 2 : 1;
            let url = location.protocol + '//' + location.host + '/shipping-cost';
            axios.get(url, {
                params: {
                    districtId: districtId,
                    wardCode: wardCode,
                    weight: {{ $weight }},
                    shipping: shipping,
                    insurance_value: {{ $total }},
                }
            })
                .then(function (response) {
                    console.log(response)
                    shippingCost.innerHTML = response.data.data.total;
                    shippingFee.value = response.data.data.total;
                    totalCost.innerHTML = response.data.data.total + {{ $total }};
                    totalPrice.value = response.data.data.total + {{ $total }};
                    subtotalPrice.value = {{ $total }};
                })
                .catch((e) => {
                    console.log(e)
                })
        }

        addressDetails.addEventListener('change', setAddress);

        function setAddress() {
            let provinceName = province.firstElementChild.options[province.firstElementChild.selectedIndex].text;
            let districtName = district.firstElementChild.options[district.firstElementChild.selectedIndex].text;
            let wardName = ward.firstElementChild.options[ward.firstElementChild.selectedIndex].text;
            let addressDetailsValue = addressDetails.value;
            orderAddress.value = `${addressDetailsValue}, ${wardName}, ${districtName}, ${provinceName}`
        }
    </script>
    <script>
        // Other address Panel
        $('#other_addr input').on("change", function () {
            if (this.checked)
                $('#other_addr_c').fadeIn('fast');
            else
                $('#other_addr_c').fadeOut('fast');
        });
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{!! Vite::asset('resources/css/checkout.css') !!}">
@endsection
