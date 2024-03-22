@extends('admin.app')

@section('title', 'Admin Create Book')

@section('content')
    <form id="create-form" class="m-5" action="{{ route('admin.book.store') }}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="mb-3">
                <label for="book-name">Name</label>
                <input name="name" type="text" class="form-control" id="book-name" placeholder="Name"
                       required>
            </div>
            <div class="mb-3">
                <label for="book-image">Image</label>
                <input name="image_file" type="file" class="form-control" id="book-image">
            </div>
            <div class="mb-3">
                <label for="book-authors">Author(s)</label>
                <input id="search-author" type="text" class="form-control mb-3" placeholder="Search Author's name">
                <ul class="list-group">
                    @foreach($author as $author)
                        <li class="author-element list-group-item">
                            <div class="d-flex justify-content-between">
                                <div class="author-data">
                                    {{ $author->name }}
                                </div>
                                <input class="check-author" name="author_id[]" type="checkbox" value="{{ $author->id }}">
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="mb-3">
                <label for="book-genres">Genre(s)</label>
                <input id="search-genre" type="text" class="form-control mb-3" placeholder="Search Genre's name">
                <ul class="list-group">
                    @foreach($genre as $genre)
                        <li class="genre-element list-group-item">
                            <div class=" d-flex justify-content-between">
                                <div class="genre-data">
                                    {{ $genre->name }}
                                </div>
                                <input class="check-genre" name="genre_id[]" type="checkbox" value="{{ $genre->id }}">
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="mb-3">
                <label for="book-publisher">Publisher</label>
                <input name="publisher" type="text" class="form-control" id="book-publisher" placeholder="Publisher"
                       required>
            </div>
            <div class="mb-3">
                <label for="book-publish-year">Publish Year</label>
                <input name="publish_year" type="number" class="form-control" id="book-publish-year"
                       placeholder="Publish Year"
                       required>
            </div>
            <div class="mb-3">
                <label for="book-description">Description</label>
                <textarea name="description" class="form-control" rows="10" id="book-description"
                          placeholder="Description"
                          required></textarea>
            </div>
            <div class="mb-3">
                <label for="book-quantity">Weight (gram)</label>
                <input name="weight" type="number" class="form-control" id="book-weight" placeholder="Weight"
                       required>
            </div>
            <div class="mb-3">
                <label for="book-quantity">Quantity</label>
                <input name="quantity" type="number" class="form-control" id="book-quantity" placeholder="Quantity"
                       required>
            </div>
            <div class="mb-3">
                <label for="book-status">Status</label>
                <select id="book-status" class="form-control form-select" name="status">
                    <option value="1" selected>On</option>
                    <option value="0">Off</option>
                </select>
            </div>
        </div>
        <div class="form-group float-end">
            <button class="btn btn-primary" id="submit-btn" type="submit">Confirm Create</button>
            <a class="btn btn-secondary" href="{{ route('admin.book.index') }}">Cancel</a>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        const searchGenreBtn = document.getElementById('search-genre');
        const genreElements = document.querySelectorAll('.genre-element');
        const genreChecks = document.querySelectorAll('.check-genre')

        const hideGenre = () => {
            genreElements.forEach(function (element, index) {
                if (genreChecks[index].checked) {
                    element.style.display = 'block';
                } else {
                    element.style.display = 'none';
                }
            })
        }
        hideGenre();

        searchGenreBtn.addEventListener('keyup', function (e) {
            let input = searchGenreBtn.value
            if (input == '') {
                hideGenre();
            } else {
                input = input.toLowerCase();
                let x = document.getElementsByClassName('genre-data');
                let y = document.getElementsByClassName('genre-element');

                for (var i = 0; i < x.length; i++) {
                    if (!x[i].innerHTML.toLowerCase().includes(input)) {
                        y[i].style.display = "none";
                    } else {
                        y[i].style.display = "block";
                    }
                }
            }
        })

        const searchAuthorBtn = document.getElementById('search-author');
        const authorElements = document.querySelectorAll('.author-element');
        const authorChecks = document.querySelectorAll('.check-author')

        const hideAuthor = () => {
            authorElements.forEach(function (element, index) {
                if (authorChecks[index].checked) {
                    element.style.display = 'block';
                } else {
                    element.style.display = 'none';
                }
            })
        }
        hideAuthor();

        searchAuthorBtn.addEventListener('keyup', function (e) {
            let input = searchAuthorBtn.value
            if (input == '') {
                hideAuthor();
            } else {
                input = input.toLowerCase();
                let x = document.getElementsByClassName('author-data');
                let y = document.getElementsByClassName('author-element');

                for (var i = 0; i < x.length; i++) {
                    if (!x[i].innerHTML.toLowerCase().includes(input)) {
                        y[i].style.display = "none";
                    } else {
                        y[i].style.display = "block";
                    }
                }
            }
        })
    </script>
@endsection
