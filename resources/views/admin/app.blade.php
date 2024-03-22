@php
    use \Illuminate\Support\Facades\Vite;
@endphp

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Bootstrap CSS -->
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Bootstrap Bundle with Popper -->
    <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Themify icons -->
    <link href="{{asset('themify-icons/themify-icons.css')}}" rel="stylesheet">

    <!-- DataTable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-ckfinder@41.2.0/src/index.min.js"></script>

    {{--    {!! Vite::asset('resources/css/app.css') !!}--}}
    <script src="{!! Vite::asset('resources/js/app.js') !!}"></script>

</head>
<body class="font-sans antialiased">
@include('admin.partials.navbar')
<div id="page">
    @include('admin.partials.header')
    @yield('content')
    @include('admin.partials.footer')
</div>
<div id="toTop"></div>
@yield('scripts')
<script type="module" src="{!! Vite::asset('resources/js/main.js') !!}"></script>

@yield('styles')
<style>
    #page {
        margin-top: 5rem;
    }
</style>
</body>
</html>
