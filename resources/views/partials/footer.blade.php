<footer class="revealed">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_1">About Me</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_1">
                    <ul>
                        <li><a href="https://github.com/dvsaigonese"><i class="ti-github"></i> dvsaigonese</a></li>
                        <li><a href="https://facebook.com/dvsaigonese"><i class="ti-facebook"></i> Duy Võ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_2">Genres</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_2">
                    @php
                        $genres = App\Models\Genre::all();
                    @endphp
                    <ul>
                        @foreach($genres as $genre)
                            <li><a href="{{ route('genre_filter', $genre->slug) }}">{{ $genre->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_3">Contacts</h3>
                <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                    <ul>
                        <li><i class="ti-home"></i>97845 Baker st. 567<br>Los Angeles - US</li>
                        <li><i class="ti-email"></i><a href="#0">vokhuongduy912@gmail.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_4">Keep in touch</h3>
                <div class="collapse dont-collapse-sm" id="collapse_4">
                    <div id="newsletter">
                        <div class="form-group">
                            <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
                            <button type="submit" id="submit-newsletter"><i class="ti-angle-double-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row-->
        <hr>
        <div class="row add_bottom_25">
            <div class="col-lg-6">
                <ul class="additional_links">
                    <li><span>© {{ now()->year }} Võ Khương Duy</span></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
