@extends('admin.app')

@section('title', 'Admin Edit User')

@section('content')
    <form class="m-5" action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
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
                <label for="user-status">Status</label>
                <select id="user-status" class="form-control form-select" name="status">
                    <option {{$user->status == 1 ? 'selected' : ''}} value="1">On</option>
                    <option {{$user->status == 0 ? 'selected' : ''}} value="0">Off</option>
                </select>
            </div>
            <label>Roles</label>
            <div id="roles-grid" class="mb-3">

                @foreach($roles as $role)
                    @php
                        $has = false;
                    @endphp
                    @foreach($user_has_roles as $item)
                        @if($role->id == $item->role_id)
                            @php
                                $has = true;
                            @endphp
                        @endif
                    @endforeach
                    @if($has)
                        <label>
                            <input name="roles[]" type="checkbox" value="{{ $role->id }}" checked/>
                            {{ $role->name }}
                        </label>
                    @else
                        <label>
                            <input name="roles[]" type="checkbox" value="{{ $role->id }}"/>
                            {{ $role->name }}
                        </label>
                    @endif
                @endforeach
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
        $destroyUrl = route('admin.user.destroy', $user->id);
    @endphp

    <x-confirm-modal status="Delete" method="DELETE" class="confirm-modal hidden" :url="$destroyUrl"/>

    @if(session('error'))
        @php
            $message = session('error');
        @endphp
        <x-toast-message status="error" :message="$message"/>
    @endif
@endsection

@section('scripts')
    <script>
        const deleteBtn = document.getElementById('delete-btn');
        deleteBtn.addEventListener('click', () => {
            openModal();
        });
    </script>
@endsection

@section('styles')
    <style>
        #roles-grid {
            display: grid;
            grid-gap: 10px;
            grid-template-columns: 1fr 1fr 1fr;
        }
    </style>
@endsection
