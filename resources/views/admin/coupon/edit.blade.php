@extends('admin.app')

@section('title', 'Admin Create Coupon')

@section('content')
    <form id="create-form" class="m-5" action="{{ route('admin.coupon.edit', $coupon->id) }}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="mb-3">
                <label for="coupon-name">Name</label>
                <input name="name" type="text" class="form-control" id="coupon-name" placeholder="Name"
                       value="{{ $coupon->name }}"
                       required>
            </div>
            <div class="mb-3">
                <label for="coupon-code">Code</label>
                <input name="code" type="text" class="form-control" id="coupon-code" placeholder="Code"
                       value="{{ $coupon->code }}"
                       required>
            </div>
            <div class="mb-3">
                <label for="coupon-type">Type</label>
                <select id="coupon-type" class="form-control form-select" name="type">
                    <option {{$coupon->status == 'percentage' ? 'selected' : ''}}>Percentage</option>
                    <option {{$coupon->status == 'direct' ? 'selected' : ''}}>Direct price reduction</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="coupon-code">Value</label>
                <input name="discount_value" type="number" class="form-control" id="coupon-value" placeholder="Value"
                       value="{{ $coupon->discount_value }}"
                       required>
            </div>
            <div class="mb-3">
                <label for="coupon-status">Status</label>
                <select id="coupon-status" class="form-control form-select" name="status">
                    <option {{$coupon->status == 1 ? 'selected' : ''}} selected>On</option>
                    <option {{$coupon->status == 0 ? 'selected' : ''}}>Off</option>
                </select>
            </div>
        </div>
        <div class="form-group float-end">
            <button class="btn btn-primary" id="submit-btn" type="submit">Confirm Edit</button>
            <a class="btn btn-secondary" href="{{ route('admin.coupon.index') }}">Cancel</a>
            <div class="btn btn-danger" id="delete-btn">Delete Coupon</div>
        </div>
    </form>
    @php
        $destroy_url =  route('admin.coupon.destroy', $coupon->id);
    @endphp
    <x-confirm-modal status="Delete" method="DELETE" class="confirm-modal hidden" :url="$destroy_url"/>

    @if(session('error'))
        @php
            $message = session('error');
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
    <script>
        const couponType = document.getElementById('coupon-type');
        const couponValue = document.getElementById('coupon-value');

        function setValueByCouponType(couponType) {
            let value = couponValue.value;
            console.log(couponType, value);
            if (couponType == 'percentage' || couponType == 'Percentage') {
                if (value <= 0 || value > 100) {
                    alert('Coupon value must be between 0 and 100');
                    couponValue.value = 1;
                }
            } else if (couponType == 'direct' || couponType == 'Direct price reduction') {
                if (value <= 0) {
                    alert('Coupon value must be higher than zero.');
                    couponValue.value = 1;
                }
            }
        }

        couponValue.addEventListener('input', function (event) {
            setValueByCouponType(couponType.value)
        })
    </script>

    <script>
        const deleteBtn = document.getElementById('delete-btn');
        deleteBtn.addEventListener('click', () => {
            openModal();
        })
    </script>
@endsection

