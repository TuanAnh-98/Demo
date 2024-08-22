@extends('layouts.layoutmaster')

@section('title', 'Chi Tiết Sản Phẩm')

@section('content')
<section class="products_details_page">
    <div class="container">
        <div class="row">
            <div class="" style="width:70%">
                <div class="clearfix">
                    <div class="featured-image">
                        <img id="product-featured-image" class="img-responsive" src="{{ asset($product->imageUrl) }}"
                            alt="{{ $product->name }}">
                    </div>
                </div>
            </div>
            <div class="" style="width:30%">
                <div class="products_details_info sidebar_banner ok" style="margin-top: 100px;">
                    <div class="tilte_producst">
                        <strong>
                            <h1 itemprop="name">{{ $product->name }}</h1>
                        </strong>
                    </div>
                    <br />
                    <br />
                    <br />
                    <br />
                    <div class="product-vendor">
                        <div itemscope="" itemtype="http://schema.org/ItemAvailability">
                            <span itemprop="supersededBy" style="display:inline-block;"><strong>Tình trạng:
                                </strong><span class="status_text">Còn hàng </span></span>
                        </div>
                    </div>
                    <div class="price-box price_products_main" itemscope="" itemtype="http://schema.org/Offer">
                        <span class="special-price">
                            <strong>Giá tiền:</strong>
                            <span class="status_text">
                                {{ $product->price . ' VND' }}
                            </span>
                        </span>
                    </div>
                    <br />
                    <div class="start_products_main">
                        <span class="special-price">
                            <strong>Thông tin sản phẩm:</strong>
                            <span class="status_text">
                                {{ $product->description }}
                            </span>
                        </span>
                    </div>
                    <br />
                    <br />
                    <br />
                    <div class="transport_products_main">
                        <img src="//bizweb.dktcdn.net/100/016/099/themes/880619/assets/icon_truck.png?1676343158115"
                            style="margin:5px 10px 5px 10px">
                        <span>Miễn phí vận chuyển đơn hàng từ 800.000 đ</span>
                    </div>
                    <br />
                    <div class="action_button_product">
                        <div class="form-product">
                            <form action="{{ route('cart.add', $product->id) }}" method="POST"
                                class="variants hover_action btn_buy_view" enctype="multipart/form-data">
                                @csrf
                                <button type="submit" class="btn_buy add_to_cart" title="Thêm vào giỏ hàng">
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
                </div>
            </div>
        </div>
    </div>
</section>
@endsection