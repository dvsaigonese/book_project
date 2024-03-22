@extends('layouts.app')

@section('title', Auth::user()->name . '\'s wishlist')

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
                <h1>Your Wishlist</h1>
            </div>
            <!-- /page_header -->
            <table class="table table-striped cart-list">
                <thead>
                <tr>
                    <th>
                        Books
                    </th>
                    <th>
                        Price
                    </th>
                    <th>
                        Details
                    </th>
                    <th>
                        Delete
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($wishlists as $wishlist)
                    <tr>
                        <td>
                            <div class="thumb_cart">
                                <img src="{{ $wishlist->image }}" class="lazy" alt="Image">
                            </div>
                            <span class="item_cart">{{ $wishlist->name }}</span>
                        </td>
                        <td>
                            <strong>{{ $wishlist->book_price }}</strong>
                        </td>
                        <td class="options">
                            <button class="btn btn-outline-primary"><a class="m-0" href="{{ route('details', $wishlist->slug) }}"><i class="ti-info"></i></a></button>
                        </td>
                        <td class="options">
                            <form action="{{ route('wishlist.destroy', $wishlist->book_id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger" type="submit"><i class="ti-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- /cart_actions -->

        </div>
        <!-- /container -->
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

@section('styles')
    <link rel="stylesheet" href="{!! Vite::asset('resources/css/cart.css') !!}">
@endsection
