@extends('admin.app')

@section('title', 'Admin User')

@section('content')
    @isset($toast)
        <x-toast-message :status="$toast['status']" :message="$toast['message']"/>
    @endisset
    <a class="btn btn-danger float-end" href="{{ route('admin.user.create') }}"> <i class="ti-plus"></i> Create New</a>
    @livewire('user-table')
@endsection

@section('scripts')
@endsection
