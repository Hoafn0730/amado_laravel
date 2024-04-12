@extends('layouts.app')

@section('content')
<div class="products-catagories-area">
    <div class="container-fluid">


        <div class="row">
            <div class="col-12">
                <div class="product-topbar d-xl-flex align-items-end justify-content-between">
                    <div>
                        <h2 class="cart-title mt-50">Tìm kiếm</h2>
                        <p>{{$products->count()}} kết quả cho từ khóa "{{$query}}"</p>
                    </div>
                    <!-- Total Products -->
                    <div class="total-products">
                        <p>Hiển thị {{$products->currentPage()}}-8 0f {{$products->count()}}</p>
                        <div class="view d-flex">
                            <a href="#"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            @foreach($products as $product)
            <!-- Single Product Area -->
            <div class="col-12 col-sm-4 col-md-12 col-xl-4">
                <div class="single-product-wrapper">
                    <!-- Product Image -->
                    <div class="product-img">
                        <img src="{{asset($product->image)}}" alt="">
                        <!-- Hover Thumb -->
                        <!-- <img class="hover-img" src="{{asset('img/product-img/product2.jpg')}}" alt=""> -->
                    </div>

                    <!-- Product Description -->
                    <div class="product-description d-flex align-items-center justify-content-between">
                        <!-- Product Meta Data -->
                        <div class="product-meta-data">
                            <div class="line"></div>
                            <p class="product-price">{{$product->price}}đ</p>
                            <a href="/products/{{$product->slug}}">
                                <h6>{{$product->name}}</h6>
                            </a>
                        </div>
                        <!-- Ratings & Cart -->
                        <div class="ratings-cart text-right">
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="cart">
                                <a href="{{route('cart.add', $product->id)}}" data-toggle="tooltip"
                                    data-placement="left" title="Add to Cart"><img
                                        src="{{asset('img/core-img/cart.png')}}" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


        </div>

        <div class=" row">
            <div class="col-12">
                <!-- Pagination -->
                <nav aria-label="navigation">
                    <ul class="pagination justify-content-end mt-50">

                        {{$products->links()}}

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>


@endsection