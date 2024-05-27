@extends('layouts.app')

@section('title', $book->name)

@section('content')
    <div class="container margin_30">
        <div class="countdown_inner">-20% This offer ends in
            <div data-countdown="2029/05/15" class="countdown"></div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <img class="w-100" src="{{ asset($book->image) }}"/>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Category</a></li>
                        <li>Page active</li>
                    </ul>
                </div>
                <!-- /page_header -->
                <div class="prod_info">
                    <h1>{{ $book->name }}</h1>
                    <span>
                        @if($score == null)
                            <p> This book has not received any reviews yet.</p>
                        @else
                            <p><small>Rating: {{ number_format($score, 2) }}/5<br>This book has {{ count($reviews) }} review(s).</small></p>
                        @endif
                    </span>
                    <p><small>SKU: MTKRY-001</small><br>{{ $book->description }}</p>
                    <div class="box-tag">
                        <div class="row mb-2">
                            <div class="col">
                                <div class="fw-bold">Author(s)</div>
                                @if ($authors[0]->name == null)
                                    <span>Anonymous author</span>
                                @else
                                    @foreach($authors as $author)
                                        <a href="{{ route('author_filter', $author->slug) }}">{{ $author->name }}
                                            <br></a>
                                    @endforeach
                                @endif
                            </div>
                            <div class="col">
                                <div class="fw-bold">Publisher</div>
                                <span>{{ $book->publisher }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="fw-bold">Publication Year</div>
                                <span>{{ $book->publish_year }}</span>
                            </div>
                            <div class="col">
                                <div class="fw-bold">Genre(s)</div>
                                @if ($genres[0]->name == null)
                                    <span>Anonymous genre</span>
                                @else
                                    @foreach($genres as $genre)
                                        <a href="{{ route('genre_filter', $genre->slug) }}">{{ $genre->name }}<br></a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <div class="prod_options">
                            <div class="row">
                                <label class="col-xl-5 col-lg-5  col-md-6 col-6"><strong>Quantity</strong></label>
                                <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                    <div class="numbers-row">
                                        <input type="text" value="1" id="quantity_1" class="qty2" name="quantity">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="price_main"><span class="new_price">{{ $book->book_price }}</span><span
                                        class="percentage">-20%</span> <span class="old_price">$160.00</span></div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="btn_add_to_cart">
                                    <button type="submit" class="btn_1">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                        <input name="book_id" value="{{ $book->id }}" class="d-none">
                        <input name="book_price" value="{{ $book->book_price }}" class="d-none">
                    </form>
                </div>
                <!-- /prod_info -->
                <div class="product_actions">
                    <ul>
                        <li>
                            <form action="{{ route('wishlist.store') }}" method="POST">
                                @csrf
                                <input name="book_id" value="{{ $book->id }}" class="d-none">
                                <button class="btn btn-outline-primary" type="submit"><i class="ti-heart"></i><span> Add to Wishlist</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                <!-- /product_actions -->
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
    <div class="tab_content_wrapper">
        <div class="container">
            <div class="tab-content" role="tablist">
                <div >
                    <div class="card-header" role="tab" id="heading-A">
                        <h5 class="mb-0">
                            <a
                               aria-controls="collapse-A">
                                Description
                            </a>
                        </h5>
                    </div>
                    <div>
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col">
                                    {{ $book->description }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /TAB A -->
                <div>
                    <div class="card-header" role="tab" id="heading-B">
                        <h5 class="mb-0">
                            <a
                               aria-controls="collapse-B">
                                Reviews
                            </a>
                        </h5>
                    </div>
                    <div>
                        <div class="card-body">
                            <div class="row justify-content-between">
                                @if($reviews[0]->score == null)
                                    <h3> This book has not received any reviews yet.</h3>
                                @else
                                    @foreach($reviews as $review)
                                        <div class="col-lg-6">
                                            <div class="review_content">
                                                <div class="clearfix add_bottom_10">
                                                    <span class="rating">
                                                    @for($i = 0; $i < $review->score; $i++)
                                                            <i class="icon-star"></i>
                                                        @endfor
                                                        @if($review->score < 5)
                                                            @for($i = $review->score; $i < 5; $i++)
                                                                <i class="icon-star empty"></i>
                                                            @endfor
                                                        @endif
                                                    <em>{{ $review->score }}/5</em>
                                                    </span>
                                                    @php
                                                        $datetime1 = strtotime($review->created_at);
                                                        $datetime2 = time();

                                                        $secs = $datetime2 - $datetime1;
                                                        $days = round($secs / 86400, 0, PHP_ROUND_HALF_DOWN);
                                                    @endphp
                                                    <em>Published {{ $days }} day(s) ago</em>

                                                </div>
                                                <h4>"{{ $review->title }}"</h4>
                                                <p>{{ $review->description }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{ $reviews->links() }}
                                @endif
                            </div>
                            <!-- /row -->
                            <p class="text-end"><a href="{{ route('review', $book->slug) }}" class="btn_1">Leave a review</a></p>
                        </div>
                        <!-- /card-body -->
                    </div>
                </div>
                <!-- /tab B -->
            </div>
            <!-- /tab-content -->
        </div>
        <!-- /container -->
    </div>
    <!-- /tab_content_wrapper -->

    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Related</h2>
            <span>Products</span>
            <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
        </div>
        <div class="owl-carousel owl-theme  products_carousel">
            @foreach($related as $book)
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon new">New</span>
                        <figure>
                            <a href="{{ route('details', $book->slug) }}">
                                <img class="img-fluid lazy" src="{{ asset($book->image) }}" />
                            </a>
                        </figure>
                        <a href="{{ route('details', $book->slug) }}">
                            <h3>{{ $book->name }}</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">{{ $book->book_price }}</span>
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

            <!-- /item -->
        </div>
        <!-- /products_carousel -->
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

@section('scripts')
    <script>
        const deleteBtn = document.getElementById('delete-btn');
        deleteBtn.addEventListener('click', () => {
            openModal();
        })
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{!! Vite::asset('resources/css/details.css') !!}">
@endsection
