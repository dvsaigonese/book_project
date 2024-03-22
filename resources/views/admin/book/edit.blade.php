@extends('admin.app')

@section('title', 'Admin Edit Book')

@section('content')
    <form class="m-5" action="{{ route('admin.book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="mb-3">
                <label for="book-id">Book ID</label>
                <input name="id" type="text" class="form-control" id="book-id" placeholder="ID"
                       value="{{ $book->id }}" required readonly>
            </div>
            <div class="mb-3">
                <label for="book-name">Name</label>
                <input name="name" type="text" class="form-control" id="book-name" placeholder="Name"
                       value="{{ $book->name }}" required>
            </div>
            <div class="mb-3">
                <label for="book-image">Image</label>
                @if( $book->image )
                    <img src="{{ asset($book->image) }}" alt="{{ $book->name }}" width="100" height="100">
                @endif
                <input name="image_file" type="file" class="form-control" id="book-image">
            </div>
            <div class="mb-3">
                <label for="book-authors">Author(s)</label>
                <ul class="list-group">
                    <a class="btn btn-outline-primary" href="{{ route('admin.book.addAuthorView', $book->id) }}">Add new
                        author</a>
                    @foreach($author as $author)
                        <div class="list-group-item genre-element">
                            {{ $author->name }}
                            <button
                                class="btn-outline-danger btn float-end"
                                formaction="{{ route('admin.book.deleteBookAuthor', ['book' => $book->id, 'author' => $author->id]) }}"
                                formmethod="post"
                                @method('delete')
                                <i class="ti-trash"></i>
                            </button>
                        </div>
                    @endforeach
                </ul>
            </div>
            <div class="mb-3">
                <label for="book-genres">Genre(s)</label>
                <ul class="list-group">
                    <a class="btn btn-outline-primary" href="{{ route('admin.book.addGenreView', $book->id) }}">Add new
                        genre</a>
                    @foreach($genre as $genre)
                        <div class="list-group-item author-element">
                            {{ $genre->name }}
                            <button
                                class="btn-outline-danger btn float-end"
                                formaction="{{ route('admin.book.deleteBookGenre', ['book' => $book->id, 'genre' => $genre->id]) }}"
                                formmethod="post"
                            @method('delete')
                            <i class="ti-trash"></i>
                            </button>
                        </div>
                    @endforeach
                </ul>
            </div>
            <div class=" mb-3">
                        <label for="book-publisher">Publisher</label>
                        <input name="publisher" type="text" class="form-control" id="book-publisher"
                               placeholder="Publisher"
                               value="{{ $book->publisher }}" required>
            </div>
            <div class="mb-3">
                <label for="book-publish-year">Publish Year</label>
                <input name="publish_year" type="number" class="form-control" id="book-publish-year"
                       placeholder="Publish Year"
                       value="{{ $book->publish_year }}" required>
            </div>
            <div class="mb-3">
                <label for="book-description">Description</label>
                <textarea name="book_description" class="form-control" rows="10" id="book-description"
                          placeholder="Description"
                          required>{{ $book->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="book-quantity">Weight (gram)</label>
                <input name="weight" type="number" class="form-control" id="book-weight" placeholder="Weight"
                       value="{{ $book->weight }}" required>
            </div>
            <div class="mb-3">
                <label for="book-quantity">Quantity</label>
                <input name="quantity" type="number" class="form-control" id="book-quantity" placeholder="Quantity"
                       value="{{ $book->quantity }}" required>
            </div>
            <div class="mb-3">
                <label for="book-status">Status</label>
                <select id="book-status" class="form-control form-select" name="status">
                    <option {{$book->status == 1 ? 'selected' : ''}} value="1">On</option>
                    <option {{$book->status == 0 ? 'selected' : ''}} value="0">Off</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="book-time">Time Created</label>
                <input name="created_at" type="datetime-local" class="form-control" id="book-time" placeholder="Price"
                       value="{{ $book->created_at }}" required readonly>
            </div>
        </div>
        <div class="form-group float-end">
            <button class="btn btn-primary" id="submit-btn" type="submit">Confirm Edit</button>
            <a class="btn btn-secondary" href="{{ route('admin.book.index') }}">Cancel</a>
            <div class="btn btn-danger" id="delete-btn">Delete Book</div>
        </div>
    </form>
    @php
        $destroy_url =  route('admin.book.destroy', $book->id);
    @endphp
    <x-confirm-modal status="Delete" method="DELETE" class="confirm-modal hidden" :url="$destroy_url"/>


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
        const deleteBtn = document.getElementById('delete-btn');
        deleteBtn.addEventListener('click', () => {
            openModal();
        })
    </script>
@endsection
