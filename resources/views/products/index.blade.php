@extends('adminlte::page')
@section('title', 'Products')
@section('content_header')
    <h1>Products</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('products.create') }}" class="btn btn-primary">Create New Product</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image Url</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->imageUrl }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
