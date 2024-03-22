@extends('admin.app')

@section('title', 'Admin Book')

@section('content')
    @isset($toast)
        <x-toast-message :status="$toast['status']" :message="$toast['message']"/>
    @endisset
{{--    <a class="btn btn-danger float-end" href="{{ route('admin.book.create') }}"> <i class="ti-plus"></i> Create New</a>--}}
    @livewire('news-table')
@endsection

@section('scripts')
@endsection
