@extends('admin.app')

@section('title', 'Admin Create News')

@section('content')
    <form class="m-5" action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-row">
            <div class="mb-3">
                <label>Title</label>
                <input name="title" type="text" class="form-control" placeholder="Title" value="{{ $news->title }}"
                       required>
            </div>
            <div class="mb-3">
                <label>Author</label>
                <input name="author" type="text" class="form-control" placeholder="Author" value="{{ $news->author }}"
                       required>
            </div>
            <div class="mb-3">
                <label>Thumb Image</label>
                <input name="image_file" type="file" class="form-control" value="{{ $news->image }}" required>
            </div>
            <div class="mb-3">
                <label >Content</label>
                <textarea id="editor" name="content">{!! $news->content !!}</textarea>
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select  class="form-control form-select" name="status">
                    <option value="1" selected>On</option>
                    <option value="0">Off</option>
                </select>
            </div>
        </div>
        <div class="form-group float-end">
            <input class="btn btn-primary" id="submit-btn" type="submit">
            <a class="btn btn-secondary" href="{{ route('admin.news.index') }}">Cancel</a>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                ckfinder: {
                    uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                }
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
