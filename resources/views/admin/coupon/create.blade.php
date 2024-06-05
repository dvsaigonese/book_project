@extends('admin.app')

@section('title', 'Admin Create Coupon')

@section('content')
    <form id="create-form" class="m-5" action="{{ route('admin.coupon.store') }}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="mb-3">
                <label for="coupon-name">Name</label>
                <input name="name" type="text" class="form-control" id="coupon-name" placeholder="Name"
                       required>
            </div>
            <div class="mb-3">
                <label for="coupon-code">Code</label>
                <input name="code" type="text" class="form-control" id="coupon-code" placeholder="Code"
                       required>
            </div>
            <div class="mb-3">
                <label for="coupon-type">Type</label>
                <select id="coupon-type" class="form-control form-select" name="type">
                    <option value="percentage" selected>Percentage</option>
                    <option value="direct">Direct price reduction</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="coupon-code">Value</label>
                <input name="discount_value" type="number" class="form-control" id="coupon-value" placeholder="Value" value="1"
                       required>
            </div>
            <div class="mb-3">
                <label for="coupon-status">Status</label>
                <select id="coupon-status" class="form-control form-select" name="status">
                    <option value="1" selected>On</option>
                    <option value="0">Off</option>
                </select>
            </div>
        </div>
        <div class="form-group float-end">
            <button class="btn btn-primary" id="submit-btn" type="submit">Confirm Create</button>
            <a class="btn btn-secondary" href="{{ route('admin.coupon.index') }}">Cancel</a>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        const couponType = document.getElementById('coupon-type');
        const couponValue = document.getElementById('coupon-value');

        function setValueByCouponType(couponType){
            let value = couponValue.value;
            console.log(couponType, value);
            if (couponType == 'percentage'){
                if (value <= 0 || value > 100) {
                    alert('Coupon value must be between 0 and 100');
                    couponValue.value = 1;
                }
            } else if (couponType == 'direct') {
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
@endsection

