@extends('adminlte::page')
@section('title', 'Edit Product')
@section('content_header')
<h1>Orders</h1>
@stop
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container">
    <h2>Danh Sách Đơn Hàng</h2>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Người Đặt Hàng</th>
                <th>Tổng Tiền</th>
                <th>Phương thức thanh toán</th>
                <th>Trạng Thái</th>
                <th>Ngày Tạo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td> <!-- Hiển thị tên người đặt hàng -->
                    <td>{{ $order->total_amount }}</td>
                    <td>{{ $order->payment_method }}</td>
                    <td>
                        <form action="{{ route('orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="payment_status" onchange="this.form.submit()">
                                <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="completed" {{ $order->payment_status == 'completed' ? 'selected' : '' }}>
                                    Completed</option>
                                <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed
                                </option>
                            </select>
                        </form>
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-info">View Details</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this order?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection