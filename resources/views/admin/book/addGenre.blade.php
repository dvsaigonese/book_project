@extends('admin.app')

@section('title', 'Admin Adds Genre For Book')

@section('content')
    <a class="btn btn-secondary m-3" href="{{ route('admin.book.edit', $book->id) }}">Back to edit</a>
    <div class="m-3">
        <input id="search-genre" type="text" class="form-control mb-3" placeholder="Search Genre's name">
        <ul class="list-group">
            @foreach($genre as $genre)
                <li class="list-group-item genre-element" data-id="{{ $genre->id }}">
                    <form class="form-horizontal"
                          action="{{ route('admin.book.addBookGenre', ['book' => $book->id, 'genre' => $genre->id]) }}"
                          method="POST">
                        @csrf
                        <div>{{ $genre->name }}
                            <button class="btn-sm btn-outline-primary float-end" type="submit">
                                <i class="ti-plus"></i>
                            </button>
                        </div>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
    @if(session('error'))
        @php
            $message = session('error');
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
        const searchGenreBtn = document.getElementById('search-genre');
        const genreElements = document.querySelectorAll('.genre-element');
        const bookHasGenre = {{ $book_has_genre->pluck('genre_id') }};

        searchGenreBtn.addEventListener('keyup', function (e) {
            let input = searchGenreBtn.value
            input = input.toLowerCase();
            let x = document.getElementsByClassName('genre-element');

            for (var i = 0; i < x.length; i++) {
                if (!x[i].innerHTML.toLowerCase().includes(input)) {
                    x[i].style.display = "none";
                } else {
                    x[i].style.display = "block";
                }
            }
        })


        genreElements.forEach(function (element, index) {
            for (var i = 0; i < bookHasGenre.length; i++) {
                if (bookHasGenre[i] == element.dataset.id) {
                    element.classList.add('disabled');
                    break;
                }
            }
        })
    </script>
@endsection
