<header class="version_1">
    <div class="layer"></div><!-- Mobile menu overlay mask -->
    <div class="main_header">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
                    <div id="logo">
                        <a href="{{ route('home') }}" style="z-index: 100; color: white"><i class="ti-book"
                                                                                            style="font-size: 2.5rem"></i></a>
                    </div>
                </div>
                <nav class="col-xl-6 col-lg-7">
                    <a class="open_close" href="javascript:void(0);">
                        <div class="hamburger hamburger--spin">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                    <!-- Mobile menu button -->
                    <div class="main-menu">
                        <div id="header_menu">
                            <a href="{{ route('home') }}" style="z-index: 100; color: white"><i class="ti-book"
                                                                                                style="font-size: 2.5rem"></i></a>
                            <a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
                        </div>
                        <ul>
                            <li class="">
                                <a href="{{ route('home') }}" class="">Home</a>
                            </li>
                            <li class="submenu">
                                @php
                                    $genres = App\Models\Genre::all();
                                @endphp
                                <a href="{{ route('books') }}" class="show-submenu">Books</a>
                                <ul>
                                    @foreach($genres as $genre)
                                        <li><a href="{{ route('genre_filter', $genre->slug) }}">{{ $genre->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <!-- /menu-wrapper -->
                            </li>
                            <li class="">
                                <a href="{{ route('news') }}" class="show-submenu">News</a>
                            </li>
                            <li>
                                <a href="blog.html">Contact</a>
                            </li>
                            <li>
                                <a href="#0">About Me</a>
                            </li>
                        </ul>
                    </div>
                    <!--/main-menu -->
                </nav>
                <div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-end">
                    <a style="color: white" href="{{ route('order.index') }}"><strong class="d-flex "><i class="ti-shopping-cart text-center p-1"
                                                                                         style="font-size: 2rem"></i>
                            <div class="text-center fw-bold">TRACK <br> YOUR ORDER</div>
                        </strong></a>
                </div>
            </div>
            <!-- /row -->
        </div>
    </div>
    <!-- /main_header -->

    <div class="main_nav Sticky">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
                    <div class="custom-search-input">
                        <form action="{{ route('search') }}" method="POST">
                            @csrf
                            <input type="text" name="query" placeholder="Search">
                            <button type="submit"><i class="header-icon_search_custom"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-5 col-md-6">
                    <ul class="top_tools">
                        <li>
                            <div class="dropdown dropdown-cart">
                                @auth
                                    <a href="{{ route('cart') }}" class="cart_bt"><strong
                                            id="cart-quantity"></strong></a>
                                @endauth
                                @guest
                                    <a href="{{ route('cart') }}" class="cart_bt"></a>
                                @endguest
                            </div>
                            <!-- /dropdown-cart-->
                        </li>
                        <li>
                            <a href="{{ route('wishlist') }}" class="wishlist"><span>Wishlist</span></a>
                        </li>
                        <li>
                            <div class="dropdown dropdown-access">
                                @auth()
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">

                                        </x-slot>

                                        <x-slot name="content">
                                            <x-dropdown-link :href="route('profile.edit')">
                                                {{ __('Profile') }}
                                            </x-dropdown-link>

                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <x-dropdown-link :href="route('logout')"
                                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                    {{ __('Log Out') }}
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                @endauth
                                <a href="{{ url('/account') }}" class="access_link"><span>Account</span></a>

                                <div class="dropdown-menu">
                                    @auth()
                                        <div>{{ Auth::user()->name }}</div>
                                    @endauth
                                    @guest()
                                        <a href="{{ url('/account') }}" class="btn_1">Sign In or Sign Up</a>
                                    @endguest

                                    <ul>
                                        @auth()
                                            @if(Auth::user()->position_id == 1)
                                                <li>
                                                    <a href="{{ route('admin.dashboard') }}"><i
                                                            class="ti-dashboard"></i>Admin
                                                        Dashboard</a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="track-order.html"><i class="ti-truck"></i>Track your Order</a>
                                            </li>
                                            <li>
                                                <a href="account.html"><i class="ti-package"></i>My Orders</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('profile.edit') }}"><i class="ti-user"></i>My Profile</a>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <a href="{{ route('logout') }}"
                                                       onclick="event.preventDefault(); this.closest('form').submit();"><i
                                                            class="ti-export"></i>Log Out</a>
                                                </form>

                                            </li>
                                        @endauth
                                    </ul>
                                </div>

                            </div>
                            <!-- /dropdown-access-->
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <div class="search_mob_wp">
            <input type="text" class="form-control" placeholder="Search over 10.000 products">
            <input type="submit" class="btn_1 full-width" value="Search">
        </div>
        <!-- /search_mobile -->
    </div>
    <!-- /main_nav -->
</header>

<script>
    const URL = location.protocol + '//' + location.host + '/cart/quantity';
    var cart_quantity;
    axios.get(URL)
        .then(function (response) {
                cart_quantity = response.data;
                document.getElementById('cart-quantity').innerText = cart_quantity;
            }
        )
</script>

