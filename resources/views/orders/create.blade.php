@extends('layouts.layoutmaster')


@section('content')
<div class="container">
    <h2>Thanh Toán</h2>

    <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(session('cart'))
            <table class="carts" cellspacing="2px;">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(session('cart') as $id => $details)
                        <tr>
                            <td style="display:flex;">
                                <img src="{{ asset($details['imageUrl']) }}" alt="{{ $details['name'] }}" style="width: 200px;">
                                <div>{{ $details['name'] }}</div>
                            </td>
                            <td>{{ $details['price'] }}</td>
                            <td>{{ $details['quantity'] }}</td>
                            <td>{{ $details['price'] * $details['quantity'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <br />
        <br />
        <br />
        <div class="form-group">
            <label for="paymentMethod">Chọn phương thức thanh toán</label>
            <select name="paymentMethod" class="form-control">
                <option value="COD">Thanh toán khi nhận hàng</option>
                <option value="Bank Transfer">Chuyển khoản ngân hàng</option>
            </select>
        </div>
        <br />
        <br />
        <div class="form-group">
            <label for="totalPrice">Tổng tiền sản phẩm</label>
            <input type="text" class="form-control" id="totalPrice" readonly value="{{ session('cartTotal') }}">
        </div>
        <br />
        <br />
        <button type="submit" class="btn btn-primary">Xác nhận đơn hàng</button>
    </form>
</div>
@endsection