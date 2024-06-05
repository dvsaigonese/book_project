@extends('layouts.app')

@php
    use \Illuminate\Support\Facades\Vite;
@endphp

@section('title', 'News')

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
            <h1>News</h1>
        </div>
        <!-- /page_header -->
        <div class="row">
            <div class="col-lg-9">
                <div class="widget search_blog d-block d-sm-block d-md-block d-lg-none">
                    <div class="form-group">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search..">
                        <button type="submit"><i class="ti-search"></i></button>
                    </div>
                </div>
                <!-- /widget -->
                <div class="row">
                    @if (count($news) > 0)
                        @foreach($news as $item)
                            <div class="col-md-6">
                                <a>
                                    <article class="blog">
                                        <figure>
                                            <a href="{{ route('news.show', $item->slug) }}"><img
                                                    src="{{ asset($item->image) }}" alt="">
                                                <div class="preview"><span>Read more</span></div>
                                            </a>
                                        </figure>
                                        <div class="post_info">
                                            <small>{{ $item->created_at }}</small>
                                            <h2><a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a>
                                            </h2>
                                            {{ $item->description }}
                                            <ul>
                                                <li>
                                                    <i class="ti-user"></i>
                                                    {{ $item->author }}
                                                </li>
                                                <li>

                                                </li>
                                            </ul>
                                        </div>
                                    </article>
                                </a>
                                <!-- /article -->
                            </div>
                        @endforeach
                    @else
                        <h3>No news found.</h3>
                    @endif
                    <!-- /col -->
                </div>
                <!-- /row -->
                {{ $news->links() }}
                <!-- /pagination -->
            </div>
            <!-- /col -->

            <aside class="col-lg-3">
                <!-- /widget -->
                <div class="widget">
                    <div class="widget-title">
                        <h4>Latest Post</h4>
                    </div>
                    <ul class="comments-list">
                        @if (count($lastest) > 0)
                            @foreach($lastest as $item)
                                <li>
                                    <div class="alignleft">
                                        <a href="{{ route('news.show', $item->slug) }}"><img src="{{ $item->image }}" alt=""></a>
                                    </div>
                                    <small>{{ $item->created_at }}</small>
                                    <h3><a href="#" title="">{{ $item->title }}</a></h3>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </aside>
            <!-- /aside -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
@endsection

@section('styles')
    <link rel="stylesheet" href="{!! Vite::asset('resources/css/news.css') !!}">
@endsection
