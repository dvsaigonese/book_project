@extends('admin.app')

@section('title', 'Admin Edit Book')

@section('content')

    <form class="m-5" action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="mb-3">
                <label for="user-id">Book ID</label>
                <input name="id" type="text" class="form-control" id="user-id" placeholder="ID"
                       value="{{ $user->id }}" required readonly>
            </div>
            <div class="mb-3">
                <label for="user-name">Name</label>
                <input name="name" type="text" class="form-control" id="user-name" placeholder="Name"
                       value="{{ $user->name }}" required>
            </div>
            <div class="mb-3">
                <label for="user-email">Email</label>
                <input name="email" type="text" class="form-control" id="user-email" placeholder="Email"
                       value="{{ $user->email }}" required>
            </div>
            <div class="mb-3">
                <label for="user-phone">Phone</label>
                <input name="phone" type="text" class="form-control" id="user-phone"
                       placeholder="Phone"
                       value="{{ $user->phone }}" required>
            </div>
            <div class="mb-3">
                <label for="user-status">Status</label>
                <select id="user-status" class="form-control form-select" name="status">
                    <option {{$user->status == 1 ? 'selected' : ''}} value="1">On</option>
                    <option {{$user->status == 0 ? 'selected' : ''}} value="0">Off</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="user-position">Position</label>
                <select id="user-position" class="form-control" name="position">
                    @foreach($positions as $position)
                        <option value="{{ $position->id }}" {{ $position->id == $user->position_id ? 'selected': "" }} >{{ $position->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="user-time">Registration time</label>
                <input name="created_at" type="datetime-local" class="form-control" id="user-time" placeholder="Price"
                       value="{{ $user->created_at }}" required readonly>
            </div>
        </div>
        <div class="form-group float-end">
            <button class="btn btn-primary" id="submit-btn" type="submit">Confirm Edit</button>
            <a class="btn btn-secondary" href="{{ route('admin.user.index') }}">Cancel</a>
            <div class="btn btn-danger" id="delete-btn">Delete User</div>
        </div>
    </form>
    @php
        $destroy_url =  route('admin.user.destroy', $user->id);
    @endphp
    <x-confirm-modal status="Delete" method="DELETE" class="confirm-modal hidden" :url="$destroy_url"/>


    @if(session('error'))
        @php
            $message = session('error');
        @endphp
        <x-toast-message status="error" :message="$message" />
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
