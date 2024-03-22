@extends('admin.app')

@section('title', 'Admin Genre Author')

@section('content')
    <form class="m-5" action="{{ route('admin.genre.update', $genre->id) }}" method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="mb-3">
                <label for="genre-id">Book ID</label>
                <input name="id" type="text" class="form-control" id="genre-id" placeholder="ID"
                       value="{{ $genre->id }}" required readonly>
            </div>
            <div class="mb-3">
                <label for="genre-name">Name</label>
                <input name="name" type="text" class="form-control" id="genre-name" placeholder="Name"
                       value="{{ $genre->name }}" required>
            </div>
            <div class="mb-3">
                <label for="genre-name">Description</label>
                <textarea name="description" class="form-control" id="genre-description" rows="10"
                          placeholder="Description" required"
                >{{ $genre->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="genre-status">Status</label>
                <select id="genre-status" class="form-control form-select" name="status">
                    <option {{$genre->status == 1 ? 'selected' : ''}} value="1">On</option>
                    <option {{$genre->status == 0 ? 'selected' : ''}} value="0">Off</option>
                </select>
            </div>
            <div class="form-group float-end">
                <button class="btn btn-primary" id="submit-btn" type="submit">Confirm Edit</button>
                <a class="btn btn-secondary" href="{{ route('admin.genre.index') }}">Cancel</a>
                <div class="btn btn-danger" id="delete-btn">Delete Book</div>
            </div>
        </div>
    </form>
    @php
        $destroy_url =  route('admin.genre.destroy', $genre->id);
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
