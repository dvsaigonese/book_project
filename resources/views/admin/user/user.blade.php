@extends('admin.app')

@section('title', 'Admin User')

@section('content')
    @isset($toast)
        <x-toast-message :status="$toast['status']" :message="$toast['message']"/>
    @endisset
    @livewire('user-table')
@endsection
