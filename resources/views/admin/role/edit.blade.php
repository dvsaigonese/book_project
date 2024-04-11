@extends('admin.app')

@section('title', 'Admin Edit Role')

@section('content')
    <form class="m-5" action="{{ route('admin.role.update', $role->id) }}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-row">
            <div class="mb-3">
                <label>Name</label>
                <input name="name" type="text" class="form-control" placeholder="Name" value="{{ $role->name }}"
                       required>
            </div>
            <div id="permissions-grid" class="mb-3">
                @foreach($permissions as $permission)
                    @php
                        $has = false;
                    @endphp
                    @foreach($role_has_permissions as $item)
                        @if($permission->id == $item->permission_id)
                            @php($has = true)
                        @endif
                    @endforeach
                    @if($has)
                        <label>
                            <input name="permissions[]" type="checkbox" value="{{ $permission->id }}"
                                   class="permission-btn"
                                   checked/>
                            {{ $permission->name }}
                        </label>
                    @else
                        <label>
                            <input name="permissions[]" type="checkbox" value="{{ $permission->id }}"
                                   class="permission-btn"/>
                            {{ $permission->name }}
                        </label>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="form-group float-end">
            <button class="btn btn-primary" id="submit-btn" type="submit">Confirm Edit</button>
            <a class="btn btn-secondary" href="{{ route('admin.role.index') }}">Cancel</a>
        </div>
    </form>
@endsection

@section('styles')
    <style>
        #permissions-grid {
            display: grid;
            grid-gap: 10px;
            grid-template-columns: 1fr 1fr 1fr;
        }
    </style>
@endsection

