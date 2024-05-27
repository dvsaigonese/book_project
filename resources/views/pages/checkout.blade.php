@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="container margin_30">
        <div class="page_header">
            <h1>Checkout</h1>

        </div>
        <!-- /page_header -->

        <div class="row">
            <form id="checkout-form" method="POST">
                <div class="row">
                    @csrf
                    <div id="left-container" class="col-lg-6 col-md-6 col-sm-12">
                        <div id="panel1" class="">
                            <div class="step first">
                                <h3>User Info and Billing address</h3>
                                <div class="tab-content checkout">
                                    <div class="tab-pane fade show active" id="tab_1" role="tabpanel"
                                         aria-labelledby="tab_1">
                                        <div class="form-group">
                                            <input id="checkout-name" type="text" name="order_name"
                                                   class="form-control checkout-input" placeholder="Name"
                                                   required>
                                        </div>
                                        <div class="form-group">
                                            <input id="checkout-telephone" type="text" name="order_phone"
                                                   class="form-control checkout-input" placeholder="Telephone"
                                                   required>
                                        </div>
                                        <h6>Address</h6>
                                        <div class="col-md-12 form-group" id="checkout-province">
                                            <select id="checkout-province"
                                                    class="wide add_bottom_15 form-select checkout-input"
                                                    required>
                                                <option value="" selected>Province</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group" id="checkout-district">
                                            <select id="checkout-district"
                                                    class="wide add_bottom_15 form-select checkout-input"
                                                    required>
                                                <option value="" selected>District</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group" id="checkout-ward">
                                            <select id="checkout-ward"
                                                    class="wide add_bottom_15 form-select checkout-input"
                                                    required>
                                                <option value="" selected>Ward</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input id="address-details" type="text" class="form-control checkout-input"
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
                        <div id="form-add-coupon" class="col-lg-9">
                            Add your voucher (if any)
                            <div class="row">

                                <div class="mb-3 col-lg-5">
                                    <input name="code" type="text" class="form-control" id="coupon-code"/>
                                </div>
                                <input id="coupon-total" name="total" class="d-none" value=""/>
                                <div class="col-lg-3">
                                    <div class="btn-primary btn " id="coupon-code-btn">Apply</div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="btn-danger btn" id="remove-coupon-btn">Remove</div>
                                </div>
                            </div>
                        </div>
                        <input value="" class="d-none" name="subtotal_price" id="subtotal-price">
                        <input value="" class="d-none" name="total_price" id="total-price">
                    </div>
                    <div id="right-container" class="col-lg-6 col-md-6 col-sm-12">
                        <div id="second-col" class="">
                            <div class="step last">
                                <h3>Order Details</h3>
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
                                        <li class="clearfix"><em><strong>Subtotal</strong></em>
                                            <span>{{ $total }}</span>
                                        </li>
                                        <li class="clearfix"><em><strong>Shipping</strong></em>
                                            <span id="shipping-cost">0</span>
                                            <input value="0" class="d-none" name="shipping_fee" id="shipping-fee">
                                        </li>
                                        <li class="clearfix"><em><strong>Discount</strong></em>
                                            <span id="discount-value">
                                            0
                                    </span>
                                            <input value="0" class="d-none" name="discount" id="discountValue">
                                            <input value="0" class="d-none" name="coupon_id" id="discountId">
                                        </li>
                                    </ul>

                                    <div class="total clearfix">TOTAL <span id="total-cost">
                                        {{ $total }}
                                </span>
                                    </div>
                                </div>
                                <!-- /box_general -->
                                <div class="step middle payments">
                                    <h3>Confirm and Payment</h3>
                                    <ul>
                                        <li>
                                            <button formaction="{{ route('vnpay_payment') }}"
                                                    class="btn btn-primary w-100"
                                                    name="redirect" type="submit">VN PAY
                                            </button>
                                        </li>
                                        <li>
                                            <button formaction="{{ route('cash_on_delivery') }}"
                                                    class="btn btn-primary w-100"
                                                    type="submit">Cash on delivery
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /step -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /row -->


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
        <!-- /container -->
        @endsection

        @section('scripts')
            <script>

                function nextStep() {
                    var input1Value = document.getElementById("checkout-name").value.trim();
                    var input2Value = document.getElementById("checkout-telephone").value.trim();
                    var input3Value = document.getElementById("checkout-province").value;
                    var input4Value = document.getElementById("checkout-district").value;
                    var input5Value = document.getElementById("checkout-ward").value;
                    var input6Value = document.getElementById("address-details").value.trim();

                    if (input1Value === ""
                        || input2Value === ""
                        || input3Value === ""
                        || input4Value === ""
                        || input5Value === ""
                        || input6Value === ""
                    ) {
                        alert("Please fill in all information.");
                    } else if (!/^\d{10}$/.test(input2Value)) {
                        alert("Please enter a valid phone number.");
                    } else {
                        if (currentStep < 3) {
                            renderDiv(currentStep + 1);
                        }
                    }
                }

                function prevStep() {
                    if (currentStep > 1) {
                        renderDiv(currentStep - 1);
                    }
                }
            </script>
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
                const couponBtn = document.querySelector('#coupon-btn');
                const formAddCoupon = document.querySelector('#form-add-coupon');
                const couponTotal = document.querySelector('#coupon-total');


                document.getElementById('checkout-form').addEventListener('keydown', function(event) {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                    }
                });

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

                ward.firstElementChild.addEventListener('change', async function (e) {
                    let waitForShipCost = () => {
                        return new Promise((resolve, reject) => {
                            console.log('promise')
                            getShipCost();
                            setAddress();
                            resolve("Thành công");
                        })
                    }

                    waitForShipCost().then((mes) => {
                        console.log(document.querySelector('#total-cost').innerText)
                        addCoupon();

                    })
                })

                shipMethod.forEach((input) => {
                    input.addEventListener('change', function () {
                        getShipCost();
                    });
                })

                function getShipCost() {
                    let districtId = district.firstElementChild.value;
                    let wardCode = ward.firstElementChild.value;
                    let url = location.protocol + '//' + location.host + '/shipping-cost';
                    axios.get(url, {
                        params: {
                            districtId: districtId,
                            wardCode: wardCode,
                            weight: {{ $weight }},
                            shipping: 2,
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
                            couponTotal.value = response.data.data.total + {{ $total }}
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
                    sessionStorage.setItem('address-details', orderAddress.value);
                }

                const couponCodeBtn = document.querySelector('#coupon-code-btn');
                const removeCouponBth = document.querySelector('#remove-coupon-btn');
                couponCodeBtn.addEventListener('click', addCoupon);
                removeCouponBth.addEventListener('click', removeCoupon);

                function addCoupon() {
                    let couponCode = document.getElementById('coupon-code').value;
                    let url = location.protocol + '//' + location.host + '/coupons';
                    axios.post(url, {
                        code: couponCode,
                        total: document.querySelector('#total-cost').innerText,
                    })
                        .then(function (response) {
                            document.querySelector('#discount-value').innerText = response.data.discount;
                            document.querySelector('#total-cost').innerText = response.data.new_price;
                            document.querySelector('#discountId').value = response.data.coupon_id;
                            totalPrice.value = response.data.new_price;
                            document.querySelector('#discountValue').value = response.data.discount_value;
                            document.querySelector('#remove-coupon-btn').style.display = 'block';
                            document.querySelector('#coupon-code-btn').style.display = 'none';
                        })
                        .catch(function (error) {
                            if (couponCode == '') {

                            } else {
                                alert("The code is wrong or used already. Please try again.")
                            }
                        });
                }

                function removeCoupon() {
                    document.querySelector('#discount-value').innerText = 0;
                    document.querySelector('#total-cost').innerText = {{ $total }} + parseInt(document.querySelector('#shipping-fee').value);
                    document.querySelector('#remove-coupon-btn').style.display = 'none';
                    document.querySelector('#coupon-code-btn').style.display = 'block';
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
            <style>
                #remove-coupon-btn {
                    display: none;
                }
            </style>
            <link rel="stylesheet" href="{!! Vite::asset('resources/css/checkout.css') !!}">
@endsection
