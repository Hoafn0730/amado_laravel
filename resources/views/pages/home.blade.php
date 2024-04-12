@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
<div class="products-catagories-area clearfix">

    <div class="amado-pro-catagory clearfix">

        @foreach($products as $product)

        <div class="single-products-catagory clearfix">
            <a href="/products/{{$product->slug}}">
                <img src="{{$product->image}}" alt="{{$product->name}}">
                <!-- Hover Content -->
                <div class="hover-content">
                    <div class="line"></div>
                    <p>From ${{$product->price}}</p>
                    <h4>{{$product->name}}</h4>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection