@extends('admin.app')

@section('title', 'Admin Slider')

@section('content')
    @isset($toast)
        <x-toast-message :status="$toast['status']" :message="$toast['message']"/>
    @endisset
    <a class="btn btn-danger float-end" href="{{ route('admin.slider.create') }}"> <i class="ti-plus"></i> Create New</a>
    @livewire('slider-table')
@endsection

@section('scripts')
    <script>
        const sliderStatus = document.querySelectorAll('.slider-status');

        sliderStatus.forEach(function (element, index) {
            element.addEventListener('change', function (event) {
                let id = element.dataset.id;
                let changeStatus = element.checked ? 1 : 0;
                const URL = location.protocol + '//' + location.host + '/admin/sliders/status/' + id;
                console.log(URL)
                axios.put(URL, {
                    status: changeStatus,
                }).then(function (response) {
                    console.log(response.data);
                })
            });
        })
    </script>
@endsection
