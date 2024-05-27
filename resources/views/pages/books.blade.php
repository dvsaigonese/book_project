@extends('layouts.app')

@php
    use \Illuminate\Support\Facades\Vite;
@endphp

@section('title', 'All Books')

@section('content')
    <main>
        <div id="stick_here"></div>
        <div class="toolbox elemento_stick">
            <div class="container">
                <ul class="clearfix">
                    <li>
                        <div class="sort_select">
                            <select name="sort" id="sort">
                                <option value="popularity" selected="selected">Sort by popularity</option>
                                <option value="rating">Sort by average rating</option>
                                <option value="date">Sort by newness</option>
                                <option value="price">Sort by price: low to high</option>
                                <option value="price-desc">Sort by price: high to
                            </select>
                        </div>
                    </li>
                    <li>
                        <a href="#0" class="open_filters">
                            <i class="ti-filter"></i><span>Filters</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /toolbox -->
        <div class="container margin_30">
            <div class="row">
                <div class="col-lg-3" id="sidebar_fixed">
                    <div class="filter_col">
                        <div class="inner_bt"><a href="#" class="open_filters"><i class="ti-close"></i></a></div>
                        <div class="filter_type version_2">
                            <h4><a href="#filter_1" data-bs-toggle="collapse" class="opened">Genres</a></h4>
                            <div class="collapse" id="filter_1">
                                <ul>
                                    @foreach($genres as $genre)
                                        <li>
                                            <a href="{{ route('genre_filter', $genre->slug) }}" class="btn genre-filter"
                                               data-id="{{ $genre->id }}">
                                                {{ $genre->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- /filter_type -->
                        </div>
                        <!-- /filter_type -->
                        <div class="filter_type version_2">
                            <h4><a href="#filter_2" data-bs-toggle="collapse" class="opened">Price Range</a></h4>
                            <div class="collapse" id="filter_2">
                                <div class="custom-wrapper mb-5">
                                    <div class="price-input-container">
                                        <div class="price-input">
                                            <div class="price-field">
                                                <span>Min</span>
                                                <input type="number"
                                                       class="min-input"
                                                       name="min_price"
                                                       value="0">
                                            </div>
                                            <div class="price-field">
                                                <span>Max</span>
                                                <input type="number"
                                                       class="max-input"
                                                       name="max_price"
                                                       value="{{ isset($maxPrice->book_price) ? $maxPrice->book_price : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /filter_type -->
                        <div class="buttons">
                            <a href="{{ route('books') }}" class="btn_1 gray">Reset</a>
                        </div>
                    </div>
                </div>
                <!-- /col -->

                <div class="col-lg-9">
                    @if(count($books) < 1)
                        <h4 class="text-center">No Book Found</h4>
                    @else
                        @foreach($books as $book)
                            <div class="row row_item book_row_item">
                                <div class="col-sm-4">
                                    <figure>
                                        <span class="ribbon off">-30%</span>
                                        <a href="{{ route('details', $book->slug) }}">
                                            <img class="img-fluid lazy" src="{{ asset($book->image) }}" alt="">
                                        </a>
                                        <div data-countdown="2019/05/15" class="countdown"></div>
                                    </figure>
                                </div>
                                <div class="col-sm-8">
                                    <div class="rating"><i class="icon-star voted"></i><i
                                            class="icon-star voted"></i><i
                                            class="icon-star voted"></i><i class="icon-star voted"></i><i
                                            class="icon-star"></i></div>
                                    <a href="{{ route('details', $book->slug) }}">
                                        <h3>{{ $book->name }}</h3>
                                    </a>
                                    <p>{{ $book->description }}</p>
                                    <div class="price_box">
                                    <span
                                        class="new_price">{{ isset($book->book_price) ? $book->book_price : '' }}</span>
                                        <span class="old_price">$60.00</span>
                                    </div>
                                    <ul>
                                        <li>
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                @csrf
                                                <input value="1" id="quantity_1" class="d-none" name="quantity">
                                                <input name="book_id" value="{{ $book->id }}" class="d-none">
                                                <input name="book_price" value="{{ $book->book_price }}" class="d-none">
                                                <button type="submit" class="btn btn-light"><i class="ti-shopping-cart"></i></button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('wishlist.store') }}" method="POST">
                                                @csrf
                                                <input name="book_id" value="{{ $book->id }}" class="d-none">
                                                <button type="submit" class="btn btn-light"><i class="ti-heart"></i></button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                {{ $books->links() }}
            </div>
            <!-- /col -->
        </div>
        <!-- /row -->
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
    </main>
@endsection

@section('scripts')
    <script>
        const rangevalue =
            document.querySelector(".slider-container .price-slider");
        const rangeInputvalue =
            document.querySelectorAll(".range-input input");

        // Set the price gap
        let priceGap = 500;

        // Adding event listners to price input elements
        const priceInputvalue =
            document.querySelectorAll(".price-input input");
        for (let i = 0; i < priceInputvalue.length; i++) {
            priceInputvalue[i].addEventListener("input", e => {

                // Parse min and max values of the range input
                let minp = parseInt(priceInputvalue[0].value);
                let maxp = parseInt(priceInputvalue[1].value);
                let diff = maxp - minp

                if (minp < 0) {
                    alert("minimum price cannot be less than 0");
                    priceInputvalue[0].value = 0;
                    minp = 0;
                }

                // Validate the input values
                if (maxp > {{ isset($maxPrice->book_price) ? $maxPrice->book_price : '' }}) {
                    alert("maximum price cannot be greater than {{ isset($maxPrice->book_price) ? $maxPrice->book_price : '' }}");
                    priceInputvalue[1].value = {{ isset($maxPrice->book_price) ? $maxPrice->book_price : '' }};
                    maxp = {{ isset($maxPrice->book_price) ? $maxPrice->book_price : '' }};
                }

                if (minp > maxp - priceGap) {
                    priceInputvalue[0].value = maxp - priceGap;
                    minp = maxp - priceGap;

                    if (minp < 0) {
                        priceInputvalue[0].value = 0;
                        minp = 0;
                    }
                }

                // Check if the price gap is met
                // and max price is within the range
                if (diff >= priceGap && maxp <= rangeInputvalue[1].max) {
                    if (e.target.className === "min-input") {
                        rangeInputvalue[0].value = minp;
                        let value1 = rangeInputvalue[0].max;
                        rangevalue.style.left = `${(minp / value1) * 100}%`;
                    } else {
                        rangeInputvalue[1].value = maxp;
                        let value2 = rangeInputvalue[1].max;
                        rangevalue.style.right =
                            `${100 - (maxp / value2) * 100}%`;
                    }
                }
            });

            // Add event listeners to range input elements
            for (let i = 0; i < rangeInputvalue.length; i++) {
                rangeInputvalue[i].addEventListener("input", e => {
                    let minVal =
                        parseInt(rangeInputvalue[0].value);
                    let maxVal =
                        parseInt(rangeInputvalue[1].value);

                    let diff = maxVal - minVal

                    // Check if the price gap is exceeded
                    if (diff < priceGap) {

                        // Check if the input is the min range input
                        if (e.target.className === "min-range") {
                            rangeInputvalue[0].value = maxVal - priceGap;
                        } else {
                            rangeInputvalue[1].value = minVal + priceGap;
                        }
                    } else {

                        // Update price inputs and range progress
                        priceInputvalue[0].value = minVal;
                        priceInputvalue[1].value = maxVal;
                        rangevalue.style.left =
                            `${(minVal / rangeInputvalue[0].max) * 100}%`;
                        rangevalue.style.right =
                            `${100 - (maxVal / rangeInputvalue[1].max) * 100}%`;
                    }
                });
            }
        }

        const bookPrice = document.querySelectorAll('.new_price');
        const bookRowItem = document.querySelectorAll('.book_row_item');
        const minInput = document.querySelector('.min-input');
        const maxInput = document.querySelector('.max-input');

        function updatePrice() {
            console.log(minInput.value, maxInput.value);
            bookPrice.forEach(function (element, index) {
                if (parseInt(element.innerText) >= minInput.value && parseInt(element.innerText) <= maxInput.value) {
                    bookRowItem[index].style.display = 'flex';
                } else {
                    bookRowItem[index].style.display = 'none';
                }
            })
        }

        minInput.addEventListener('change', updatePrice);
        maxInput.addEventListener('change', updatePrice);

    </script>
    <script src="{!! Vite::asset('resources/js/all_books/sticky_sidebar.min.js') !!}"></script>
    <script src="{!! Vite::asset('resources/js/all_books/specific_listing.js') !!}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{!! Vite::asset('resources/css/all-books.css') !!}">
@endsection
