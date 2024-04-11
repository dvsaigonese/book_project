@extends('admin.app')

@section('title', 'Admin Book')

@section('content')
    @isset($toast)
        <x-toast-message :status="$toast['status']" :message="$toast['message']"/>
    @endisset
    <a class="btn btn-danger float-end" href="{{ route('admin.role.create') }}"> <i class="ti-plus"></i> Create New</a>
    @livewire('role-table')
    @if(session('error'))
        @php
            $message = session('error');
        @endphp
        <x-toast-message status="error" :message="$message"/>
    @endif
    @if(session('warning'))
        @php
            $message = session('warning');
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
@endsection
