@extends('admin.app')

@section('title', 'Admin Genre')

@section('content')
    @isset($toast)
        <x-toast-message :status="$toast['status']" :message="$toast['message']"/>
    @endisset
    <a class="btn btn-danger float-end" href="{{ route('admin.genre.create') }}"> <i class="ti-plus"></i> Create New</a>
    @livewire('genre-table')
@endsection

@section('scripts')
@endsection
