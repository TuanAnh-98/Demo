@extends('layouts.layoutmaster')


@section('content')
<div class="container">
    <h2>Thanh Toán</h2>

    <form action="{{ route('orders.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="paymentMethod">Chọn phương thức thanh toán</label>
            <select name="paymentMethod" class="form-control">
                <option value="COD">Thanh toán khi nhận hàng</option>
                <option value="Bank Transfer">Chuyển khoản ngân hàng</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Xác nhận đơn hàng</button>
    </form>
</div>
@endsection