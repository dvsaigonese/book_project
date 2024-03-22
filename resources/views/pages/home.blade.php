@extends('layouts.app')

@php
    use \Illuminate\Support\Facades\Vite;
@endphp

@section('title', 'Home page')

@section('content')
    <main>
        <div id="carousel-home">
            <div class="owl-carousel owl-theme">
                @foreach($sliders as $slider)
                    <div class="owl-slide cover" style="background-image: url({{asset($slider->image)}});">
                        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                            <div class="container">
                                <div class="row justify-content-center justify-content-md-end">
                                    <div class="col-lg-6 static">
                                        <div class="slide-text text-end white">
                                            <h2 class="owl-slide-animated owl-slide-title">{{ $slider->title }}</h2>
                                            <p class="owl-slide-animated owl-slide-subtitle">
                                                {{ $slider->description  }}
                                            </p>
                                            <div class="owl-slide-animated owl-slide-cta"><a class="btn_1"
                                                                                             href="{{ route('books') }}"
                                                                                             role="button">Shop Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="icon_drag_mobile"></div>
        </div>
        <!--/carousel-->

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Newest</h2>
                <span>Books</span>
                <p>Own the latest publications before they sell out.</p>
            </div>
            <div class="row small-gutters">
                @foreach($books as $book)
                    <div class="col-6 col-md-4 col-xl-3">
                        <div class="grid_item" style="height: 100%;">
                            <figure>
                                {{--                            <span class="ribbon off">-30%</span>--}}
                                <a href="{{ route('details', $book->slug) }}">
                                    <img class="img-fluid lazy" src="{{ $book->image }}"
                                         alt="">
                                </a>
                                {{--                            <div data-countdown="2019/05/15" class="countdown"></div>--}}
                            </figure>
                            <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                    class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i>
                            </div>
                            <a href="{{ route('details', $book->slug) }}">
                                <h3>{{ $book->name }}</h3>
                            </a>
                            <div class="price_box">
                                <span class="new_price">{{ $book->book_price }}</span>
                                {{--                            <span class="old_price">$60.00</span>--}}
                            </div>
                            <ul>
                                <li>
                                    <form action="{{ route('wishlist.store') }}" method="POST">
                                        @csrf
                                        <input name="book_id" value="{{ $book->id }}" class="d-none">
                                        <button type="submit" class="btn btn-light"><i class="ti-heart"></i></button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="text" value="1" id="quantity_1" class="d-none" name="quantity">
                                        <input name="book_id" value="{{ $book->id }}" class="d-none">
                                        <button type="submit" class="btn btn-light"><i class="ti-shopping-cart"></i></button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <!-- /grid_item -->
                    </div>
                @endforeach
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Latest</h2>
                <span>News</span>
                <p>Keep up with the latest information.</p>
            </div>
            <div class="row">
                @foreach($news as $item)
                    <div class="col-lg-6">
                        <a class="box_news" href="{{ route('news.show', $item->slug) }}">
                            <figure>
                                <img src="{{ $item->image }}" data-src="img/blog-thumb-1.jpg" alt="" width="400"
                                     height="266" class="lazy">
                            </figure>
                            <ul>
                                <li>by {{ $item->author }}</li>
                                <li>{{ $item->created_at }}</li>
                            </ul>
                            <h4>{{ $item->title }}</h4>
                            <p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse
                                ullum vidisse....</p>
                        </a>
                    </div>
                @endforeach
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
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
    <script type="module" src="{!!Vite::asset('resources/js/home/carousel-home.js')!!}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{!! Vite::asset('resources/css/home.css') !!}">
@endsection
