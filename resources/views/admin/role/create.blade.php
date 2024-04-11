@extends('admin.app')

@section('title', 'Admin Create Role')

@section('content')
    <form class="m-5" action="{{ route('admin.role.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="mb-3">
                <label>Name</label>
                <input name="name" type="text" class="form-control" placeholder="Name"
                       required>
            </div>
            @foreach($permissions as $permission)
                <div class="mb-3">
                    <input name="permissions[]" type="checkbox" value="{{ $permission->id }}"/>
                    <label>{{ $permission->name }}</label>
                </div>
            @endforeach
        </div>
        <div class="form-group float-end">
            <button class="btn btn-primary" id="submit-btn" type="submit">Confirm Create</button>
            <a class="btn btn-secondary" href="{{ route('admin.role.index') }}">Cancel</a>
        </div>
    </form>
@endsection

@section('script')
@endsection
