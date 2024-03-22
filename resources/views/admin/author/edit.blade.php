@extends('admin.app')

@section('title', 'Admin Edit Author')

@section('content')
    <form class="m-5" action="{{ route('admin.author.update', $author->id) }}" method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="mb-3">
                <label for="author-id">Book ID</label>
                <input name="id" type="text" class="form-control" id="author-id" placeholder="ID"
                       value="{{ $author->id }}" required readonly>
            </div>
            <div class="mb-3">
                <label for="author-name">Name</label>
                <input name="name" type="text" class="form-control" id="author-name" placeholder="Name"
                       value="{{ $author->name }}" required>
            </div>
            <div class="mb-3">
                <label for="author-name">Description</label>
                <textarea name="description" class="form-control" id="author-description" rows="10"
                          placeholder="Description" required"
                >{{ $author->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="author-status">Status</label>
                <select id="author-status" class="form-control form-select" name="status">
                    <option {{$author->status == 1 ? 'selected' : ''}} value="1">On</option>
                    <option {{$author->status == 0 ? 'selected' : ''}} value="0">Off</option>
                </select>
            </div>
            <div class="form-group float-end">
                <button class="btn btn-primary" id="submit-btn" type="submit">Confirm Edit</button>
                <a class="btn btn-secondary" href="{{ route('admin.author.index') }}">Cancel</a>
                <div class="btn btn-danger" id="delete-btn">Delete Book</div>
            </div>
        </div>
    </form>
    @php
        $destroy_url =  route('admin.author.destroy', $author->id);
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
