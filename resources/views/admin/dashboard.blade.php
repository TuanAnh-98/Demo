@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- Small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <p>Product</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-product"></i>
                    </div>
                    <a href="/products" class="small-box-footer">Danh sách sản phẩm<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- Thêm các box khác tương tự -->
        </div>
    </div>
@endsection
