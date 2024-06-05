@extends('admin.app')

@section('title', 'Admin Coupons')

@section('content')
    @isset($toast)
        <x-toast-message :status="$toast['status']" :message="$toast['message']"/>
    @endisset
    <a class="btn btn-danger float-end" href="{{ route('admin.coupon.create') }}"> <i class="ti-plus"></i> Create New</a>
    @livewire('coupon-table')
@endsection

@section('scripts')
@endsection
