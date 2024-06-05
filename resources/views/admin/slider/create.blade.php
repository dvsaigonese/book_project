@extends('admin.app')

@section('title', 'Admin Create Book')

@section('content')
    <form id="create-form" class="m-5" action="{{ route('admin.slider.store') }}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="mb-3">
                <label>Title</label>
                <input name="title" type="text" class="form-control" id="book-name" placeholder="Name"
                       >
            </div>
            <div class="mb-3">
                <label for="book-image">Image</label>
                <input name="image_file" type="file" class="form-control" id="book-image">
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" id="book-description"
                          placeholder="Description"
                          ></textarea>
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
            <a class="btn btn-secondary" href="{{ route('admin.slider.index') }}">Cancel</a>
        </div>
    </form>
@endsection

@section('scripts')
@endsection
