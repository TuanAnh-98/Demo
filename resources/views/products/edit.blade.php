@extends('adminlte::page')
@section('title', 'Edit Product')
@section('content_header')
    <h1>Edit Product</h1>
    <div>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a> 
    </div>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" step="0.01" value="{{ old('price', $product->price) }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="imageUrl">Price</label>
                    @if($product->imageUrl)
                        <div class="mb-2">
                            <img src="{{ asset($product->imageUrl) }}" alt="Current Image" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    @endif
                    <input type="file" class="form-control @error('imageUrl') is-invalid @enderror" id="imageUrl" name="imageUrl">
                    @error('imageUrl')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@stop
