@extends('layouts.layoutmaster')

@section('title', 'Giỏ Hàng')

@section('content')
<div class="container">
    <h2>Giỏ Hàng</h2>
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

        <a href="{{ url('/orders/create') }}" class="btn btn-primary">Thanh toán</a>
    @else
        <p>Giỏ hàng của bạn đang trống.</p>
    @endif
</div>

<style >
    table.carts {
        border-width: 1px;
        border-spacing: 2px;
        border-style: outset;
        border-color: gray;
        border-collapse: separate;
        background-color: white;
    }

    table.carts td {
        border-width: 1px;
        padding: 1px;
        border-style: inset;
        border-color: gray;
        background-color: white;
    }
</style>
@endsection