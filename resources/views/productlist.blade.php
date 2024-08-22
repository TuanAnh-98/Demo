@extends('layouts.layoutmaster')

@section('title', 'Danh Sách Sản Phẩm')

@section('content')
<section class="tab_top_products">
    <div class="container">
        <div>
            <h2>Danh Sách Sản Phẩm</h2>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="product-box" style="width:255px;">
                    <div class="product-thumbnail">
                        <a href="{{ route('products.show', $product->id) }}" title="{{ $product->name }}">
                            <img class="img-responsive "
                                        src="{{ asset($product->imageUrl) }}"
                                        data-src="{{ asset($product->imageUrl) }}"
                                        alt="{{ $product->name }}" data-was-processed="true" style="height:255px;">
                                    
                        </a>
                    </div>
                    <div class="product-info">
                        <h3>
                            <a href="{{ route('products.show', $product->id) }}"
                                title="{{ $product->name }}">{{ $product->name }}</a>
                        </h3>
                    </div>
                    <div class="price-box">
                        <span class="special-price">
                            <span class="price product-price">{{ $product->price . ' VND' }}</span>
                        </span>
                    </div>
                    <div class="product-action">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST"
                            class="variants hover_action btn_buy_view" enctype="multipart/form-data">
                            @csrf
                            <button type="submit" class="btn_buy add_to_cart" title="Cho vào giỏ hàng">
                                <i class="fa fa-shopping-bag"></i>
                                <strong>Thêm vào giỏ hàng</strong>
                            </button>
                            <style>
                                .btn_buy.add_to_cart,
                                .btn_buy.btn_option {
                                    width: 100%;
                                    border-right: none;
                                }
                            </style>
                        </form>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
</section>
@endsection