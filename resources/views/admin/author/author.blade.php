@extends('admin.app')

@section('title', 'Admin Author')

@section('content')
    @isset($toast)
        <x-toast-message :status="$toast['status']" :message="$toast['message']"/>
    @endisset
    <a class="btn btn-danger float-end" href="{{ route('admin.author.create') }}"> <i class="ti-plus"></i> Create New</a>
    @livewire('author-table')
@endsection

@section('scripts')
@endsection
