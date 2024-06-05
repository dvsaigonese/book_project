@extends('admin.app')

@section('title', 'Admin Edit Slider')

@section('content')
    <form id="create-form" class="m-5" action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="mb-3">
                <label>Title</label>
                <input name="title" type="text" class="form-control" id="book-name" placeholder="Name" value="{{ $slider->title ? $slider->title : '' }}"
                       >
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
                          >{{ $slider->description ? $slider->description : '' }}</textarea>
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
            <div class="btn btn-danger" id="delete-btn">Delete</div>
        </div>
    </form>
    @php
        $destroy_url =  route('admin.slider.destroy', $slider->id);
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
