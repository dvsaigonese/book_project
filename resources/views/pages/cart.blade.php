@extends('layouts.app')

@section('title', Auth::user()->name . '\'s cart')

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
            <h1>Your cart</h1>
        </div>
        <!-- /page_header -->
        <table class="table table-striped cart-list">
            <thead>
            <tr>
                <th>
                    Product
                </th>
                <th>
                    Price
                </th>
                <th>
                    Quantity
                </th>
                <th>
                    Subtotal
                </th>
                <th>
                    Details
                </th>
                <th>
                    Update
                </th>
                <th>
                    Delete
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($carts as $cart)
                <tr>
                    <form action="{{ route('cart.update') }}" method="POST">
                        @method('put')
                        @csrf
                        <input class="d-none" value="{{ $cart->book_id }}" name="book_id">
                        <td>
                            <div class="thumb_cart">
                                <img src="{{ $cart->image }}" class="lazy" alt="Image">
                            </div>
                            <span class="item_cart">{{ $cart->name }}</span>
                        </td>
                        <td>
                            <strong class="cart-price">{{ $cart->book_price }}</strong>
                        </td>
                        <td>
                            <div class="numbers-row cart-quantity">
                                <input type="text" value="{{ $cart->quantity }}" class="quantity qty2"
                                       name="quantity">
                                <div class="inc button_inc quantity_btn">+</div>
                                <div class="dec button_inc quantity_btn">-</div>
                            </div>
                        </td>
                        <td>
                            <strong class="cart-sub-total-price">{{ $cart->book_price * $cart->quantity }}</strong>
                        </td>
                        <td class="options">
                            <button class="btn btn-outline-primary"><a class="m-0"
                                                                       href="{{ route('details', $cart->slug) }}"><i
                                        class="ti-info"></i></a></button>
                        </td>
                        <td class="options">
                            <button class="btn btn-outline-success" type="submit">
                                <i class="ti-check"></i>
                            </button>
                        </td>
                    </form>
                    <td class="options">
                        <button class="btn btn-outline-danger" formaction="{{ route('cart.destroy', $cart->book_id) }}"
                                method="POST">
                            @method('DELETE')
                            @csrf<i class="ti-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


        <!-- /cart_actions -->
    </div>
    <!-- /container -->

    <div class="box_cart">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <ul>
                        <li>
                            <span>Total</span>
                            <p class="cart-total-price"></p>
                        </li>
                    </ul>
                    <a href="{{ route('checkout') }}" class="btn_1 full-width cart">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /box_cart -->
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
        const quantityInput = document.querySelectorAll('.quantity');
        const quantityBtn = document.querySelectorAll('.cart-quantity');
        const bookPrice = document.querySelectorAll('.cart-price');
        const subTotalPrice = document.querySelectorAll('.cart-sub-total-price');
        const totalPrice = document.querySelector('.cart-total-price');
        const deteleBtn = document.querySelectorAll('.cart-detele')

        setTotalPrice(totalPrice, subTotalPrice);

        quantityBtn.forEach((element, index) => {
            element.addEventListener('click', (event) => {
                setSubtotalPrice(subTotalPrice, bookPrice, quantityInput, index);
                setTotalPrice(totalPrice, subTotalPrice);
            })
        })
        quantityInput.forEach((element, index) => {
            element.addEventListener('change', (event) => {
                setSubtotalPrice(subTotalPrice, bookPrice, quantityInput, index);
                setTotalPrice(totalPrice, subTotalPrice);
            })
        })

        function setSubtotalPrice(subTotalPrice, bookPrice, quantityInput, index) {
            subTotalPrice[index].innerHTML = bookPrice[index].innerHTML * quantityInput[index].value;
        }

        function setTotalPrice(totalPrice, subTotalPrice) {
            let total = 0;
            subTotalPrice.forEach((element) => {
                total += parseInt(element.innerText);
            })
            totalPrice.innerHTML = total;
        }
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{!! Vite::asset('resources/css/cart.css') !!}">
@endsection
