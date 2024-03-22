@extends('admin.app')

@section('title', 'Admin Create Author')

@section('content')
    <form class="m-5" action="{{ route('admin.author.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="mb-3">
                <label for="author-name">Name</label>
                <input name="name" type="text" class="form-control" id="author-name" placeholder="Name"
                       required>
            </div>
            <div class="mb-3">
                <label for="author-description">Description</label>
                <textarea name="description" class="form-control" rows="10" id="author-description"
                          placeholder="Description"
                          required></textarea>
            </div>
            <div class="mb-3">
                <label for="author-status">Status</label>
                <select id="author-status" class="form-control form-select" name="status">
                    <option value="1" selected>On</option>
                    <option value="0">Off</option>
                </select>
            </div>
        </div>
        <div class="form-group float-end">
            <button class="btn btn-primary" id="submit-btn" type="submit">Confirm Create</button>
            <a class="btn btn-secondary" href="{{ route('admin.author.index') }}">Cancel</a>
        </div>
    </form>
@endsection

@section('scripts')

@endsection
