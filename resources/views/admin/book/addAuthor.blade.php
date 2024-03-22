@extends('admin.app')

@section('title', 'Admin Adds Author For Book')

@section('content')
    <a class="btn btn-secondary m-3" href="{{ route('admin.book.edit', $book->id) }}">Back to edit</a>
    <div class="m-3">
        <input id="search-author" type="text" class="form-control mb-3" placeholder="Search Author's name">
        <ul class="list-group">
            @foreach($author as $author)
                <li class="list-group-item author-element" data-id="{{ $author->id }}">
                    <form class="form-horizontal"
                          action="{{ route('admin.book.addBookAuthor', ['book' => $book->id, 'author' => $author->id]) }}"
                          method="POST">
                        @csrf
                        <div>{{ $author->name }}
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
        const searchAuthorBtn = document.getElementById('search-author');
        const authorElements = document.querySelectorAll('.author-element');
        const bookHasAuthor = {{ $book_has_author->pluck('author_id') }};

        searchAuthorBtn.addEventListener('keyup', function (e) {
            let input = searchAuthorBtn.value
            input = input.toLowerCase();
            let x = document.getElementsByClassName('author-element');

            for (var i = 0; i < x.length; i++) {
                if (!x[i].innerHTML.toLowerCase().includes(input)) {
                    x[i].style.display = "none";
                } else {
                    x[i].style.display = "block";
                }
            }
        })


        authorElements.forEach(function (element, index) {
            for (var i = 0; i < bookHasAuthor.length; i++) {
                if (bookHasAuthor[i] == element.dataset.id) {
                    element.classList.add('disabled');
                    break;
                }
            }
        })
    </script>
@endsection
