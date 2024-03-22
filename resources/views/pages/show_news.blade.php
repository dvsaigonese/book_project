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
        </div>
        <!-- /page_header -->
        <div class="row">
            <div class="col-lg-9">
                <div class="singlepost">
                    <figure><img alt="" class="img-fluid" src="{{ asset($news->image) }}"></figure>
                    <h1>{{ $news->title }}</h1>
                    <div class="postmeta">
                        <ul>
                            <li><a href="#"><i class="ti-folder"></i> Category</a></li>
                            <li><i class="ti-calendar"></i> {{ $news->created_at }}</li>
                            <li><a href="#"><i class="ti-user"></i> {{ $news->author }}</a></li>
                            <li><a href="#"><i class="ti-comment"></i> (14) Comments</a></li>
                        </ul>
                    </div>
                    <!-- /post meta -->
                    <div class="post-content mt-5">
                        <div class="dropcaps">
                            {!! $news->content !!}
                        </div>
                    </div>
                    <!-- /post -->
                </div>


                <!-- /single-post -->

                <div id="comments">
                    <h5>Comments</h5>
                    <ul>
                        <li>
                            <div class="avatar">
                                <a href="#"><img src="img/avatar1.jpg" alt="">
                                </a>
                            </div>
                            <div class="comment_right clearfix">
                                <div class="comment_info">
                                    By <a href="#">Anna Smith</a><span>|</span>25/10/2019<span>|</span><a href="#"><i
                                            class="icon-reply"></i></a>
                                </div>
                                <p>
                                    Nam cursus tellus quis magna porta adipiscing. Donec et eros leo, non pellentesque
                                    arcu. Curabitur vitae mi enim, at vestibulum magna. Cum sociis natoque penatibus et
                                    magnis dis parturient montes, nascetur ridiculus mus. Sed sit amet sem a urna
                                    rutrumeger fringilla. Nam vel enim ipsum, et congue ante.
                                </p>
                            </div>
                            <ul class="replied-to">
                                <li>
                                    <div class="avatar">
                                        <a href="#"><img src="img/avatar2.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="comment_right clearfix">
                                        <div class="comment_info">
                                            By <a href="#">Anna Smith</a><span>|</span>25/10/2019<span>|</span><a
                                                href="#"><i class="icon-reply"></i></a>
                                        </div>
                                        <p>
                                            Nam cursus tellus quis magna porta adipiscing. Donec et eros leo, non
                                            pellentesque arcu. Curabitur vitae mi enim, at vestibulum magna. Cum sociis
                                            natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                                            Sed sit amet sem a urna rutrumeger fringilla. Nam vel enim ipsum, et congue
                                            ante.
                                        </p>
                                        <p>
                                            Aenean iaculis sodales dui, non hendrerit lorem rhoncus ut. Pellentesque
                                            ullamcorper venenatis elit idaipiscingi Duis tellus neque, tincidunt eget
                                            pulvinar sit amet, rutrum nec urna. Suspendisse pretium laoreet elit vel
                                            ultricies. Maecenas ullamcorper ultricies rhoncus. Aliquam erat volutpat.
                                        </p>
                                    </div>
                                    <ul class="replied-to">
                                        <li>
                                            <div class="avatar">
                                                <a href="#"><img src="img/avatar2.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="comment_right clearfix">
                                                <div class="comment_info">
                                                    By <a href="#">Anna
                                                        Smith</a><span>|</span>25/10/2019<span>|</span><a href="#"><i
                                                            class="icon-reply"></i></a>
                                                </div>
                                                <p>
                                                    Nam cursus tellus quis magna porta adipiscing. Donec et eros leo,
                                                    non pellentesque arcu. Curabitur vitae mi enim, at vestibulum magna.
                                                    Cum sociis natoque penatibus et magnis dis parturient montes,
                                                    nascetur ridiculus mus. Sed sit amet sem a urna rutrumeger
                                                    fringilla. Nam vel enim ipsum, et congue ante.
                                                </p>
                                                <p>
                                                    Aenean iaculis sodales dui, non hendrerit lorem rhoncus ut.
                                                    Pellentesque ullamcorper venenatis elit idaipiscingi Duis tellus
                                                    neque, tincidunt eget pulvinar sit amet, rutrum nec urna.
                                                    Suspendisse pretium laoreet elit vel ultricies. Maecenas ullamcorper
                                                    ultricies rhoncus. Aliquam erat volutpat.
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="avatar">
                                <a href="#"><img src="img/avatar3.jpg" alt="">
                                </a>
                            </div>

                            <div class="comment_right clearfix">
                                <div class="comment_info">
                                    By <a href="#">Anna Smith</a><span>|</span>25/10/2019<span>|</span><a href="#"><i
                                            class="icon-reply"></i></a>
                                </div>
                                <p>
                                    Cursus tellus quis magna porta adipiscin
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>

                <hr>

                <h5>Leave a comment</h5>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <input type="text" name="name" id="name2" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <input type="text" name="email" id="email2" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <input type="text" name="email" id="website3" class="form-control" placeholder="Website">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="comments" id="comments2" rows="6"
                              placeholder="Comment"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" id="submit2" class="btn_1 add_bottom_15">Submit</button>
                </div>

            </div>
            <!-- /col -->

            <aside class="col-lg-3">
                <div class="widget search_blog">
                    <div class="form-group">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search..">
                        <button type="submit"><i class="ti-search"></i></button>
                    </div>
                </div>
                <!-- /widget -->
                <div class="widget">
                    <div class="widget-title">
                        <h4>Latest Post</h4>
                    </div>
                    <ul class="comments-list">
                        <li>
                            <div class="alignleft">
                                <a href="#0"><img src="img/blog-5.jpg" alt=""></a>
                            </div>
                            <small>Category - 11.08.2016</small>
                            <h3><a href="#" title="">Verear qualisque ex minimum...</a></h3>
                        </li>
                        <li>
                            <div class="alignleft">
                                <a href="#0"><img src="img/blog-6.jpg" alt=""></a>
                            </div>
                            <small>Category - 11.08.2016</small>
                            <h3><a href="#" title="">Verear qualisque ex minimum...</a></h3>
                        </li>
                        <li>
                            <div class="alignleft">
                                <a href="#0"><img src="img/blog-4.jpg" alt=""></a>
                            </div>
                            <small>Category - 11.08.2016</small>
                            <h3><a href="#" title="">Verear qualisque ex minimum...</a></h3>
                        </li>
                    </ul>
                </div>
                <!-- /widget -->
                <div class="widget">
                    <div class="widget-title">
                        <h4>Categories</h4>
                    </div>
                    <ul class="cats">
                        <li><a href="#">Food <span>(12)</span></a></li>
                        <li><a href="#">Places to visit <span>(21)</span></a></li>
                        <li><a href="#">New Places <span>(44)</span></a></li>
                        <li><a href="#">Suggestions and guides <span>(31)</span></a></li>
                    </ul>
                </div>
                <!-- /widget -->
                <div class="widget">
                    <div class="widget-title">
                        <h4>Popular Tags</h4>
                    </div>
                    <div class="tags">
                        <a href="#">Food</a>
                        <a href="#">Bars</a>
                        <a href="#">Cooktails</a>
                        <a href="#">Shops</a>
                        <a href="#">Best Offers</a>
                        <a href="#">Transports</a>
                        <a href="#">Restaurants</a>
                    </div>
                </div>
                <!-- /widget -->
            </aside>
            <!-- /aside -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
@endsection

@section('styles')
    <link rel="stylesheet" href="{!! Vite::asset('resources/css/news.css') !!}">
    <style>
        .dropcaps figure.image img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@endsection

@section('scripts')
    <script>
        const figure = document.querySelectorAll('figure.image');
        const figureImage = document.querySelectorAll('figure.image img');
        console.log(figure, figureImage);

        figure.forEach((element, index) => {
            if (element.offsetWidth < figureImage[index].offsetWidth) {
                console.log(element.offsetWidth, figureImage[index].offsetWidth);
                figureImage[index].style.width = '100%';
                figureImage[index].style.height = '100%';
            }
        })
    </script>
@endsection
