@extends('admin.app')

@section('title', 'Admin Edit Slider')

@section('content')
    <form id="create-form" class="m-5" action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="mb-3">
                <label>Title</label>
                <input name="title" type="text" class="form-control" id="book-name" placeholder="Name" value="{{ $slider->title }}"
                       required>
            </div>
            <div class="mb-3">
                <label for="book-image">Image</label>
                <input name="image_file" type="file" class="form-control" id="book-image" value="{{ $slider->image }}">
                <img src="{{ asset($slider->image) }}" width="140" height="80" />
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" id="book-description"
                          placeholder="Description"
                          required>{{ $slider->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="book-status">Status</label>
                <select id="book-status" class="form-control form-select" name="status">
                    <option {{$slider->status == 1 ? 'selected' : ''}} value="1">On</option>
                    <option {{$slider->status == 0 ? 'selected' : ''}} value="0">Off</option>
                </select>
            </div>
        </div>
        <div class="form-group float-end">
            <button class="btn btn-primary" id="submit-btn" type="submit">Confirm Edit</button>
            <a class="btn btn-secondary" href="{{ route('admin.slider.index') }}">Cancel</a>
        </div>
    </form>
@endsection

@section('scripts')
@endsection
