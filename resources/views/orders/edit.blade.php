@extends('adminlte::page')
@section('title', 'Order Details')
@section('content_header')
<h1>Order Details - ID: {{ $order->id }}</h1>
<div>
    <a href="{{ route('orders.index') }}" class="btn btn-primary">Back</a>
</div>
<form action="{{ route('orders.destroy', $order->id) }}" method="POST"
    onsubmit="return confirm('Are you sure you want to delete this order?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
@stop
@section('content')
<div class="container">
    <h2>Order Information</h2>
    <p><strong>Order ID:</strong> {{ $order->id }}</p>
    <p><strong>Customer Name:</strong> {{ $order->user->name ?? 'N/A' }}</p>
    <p><strong>Total Amount:</strong> {{ $order->total_amount }}</p>
    <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
    <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
    <p><strong>Order Date:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>

    <h3>Products</h3>
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach(json_decode($order->products, true) as $product)
                <tr>
                    <td><img src="{{ asset($product['imageUrl']) }}" alt="Current Image" class="img-thumbnail"
                            style="max-width: 100px;"></td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>{{ $product['price'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection