@extends('layouts.app')

@section('content')
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <form name="form-checkout" action="{{route('checkout.add', ['cart' => $cart])}}" method="post">
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-title">
                            <h2>Thanh toán</h2>
                        </div>


                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input name="first_name" type="text" class="form-control" id="first_name" value=""
                                    placeholder="First Name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input name="last_name" type="text" class="form-control" id="last_name" value=""
                                    placeholder="Last Name" required>
                            </div>
                            <div class="col-12 mb-3">
                                <input name="address" type="text" class="form-control" id="address"
                                    placeholder="Address" value="">
                            </div>
                            <div class="col-12 mb-3">
                                <input name="phone" type="text" class="form-control" id="phone" placeholder="Phone"
                                    value="">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="cart-summary">
                        <h5>Cart Total</h5>
                        <ul class="summary-table">
                            <li><span>subtotal:</span> <span>{{$cart->totalPrice}}đ</span></li>
                            <li><span>delivery:</span> <span>Free</span></li>
                            <li><span>total:</span> <span>{{$cart->totalPrice}}đ</span></li>
                        </ul>

                        <div class="payment-method">
                            <!-- Cash on delivery -->
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input name="cod" type="checkbox" class="custom-control-input" id="cod" checked>
                                <label class="custom-control-label" for="cod">Cash on Delivery</label>
                            </div>
                            <!-- Paypal -->
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input name="paypal" type="checkbox" class="custom-control-input" id="paypal">
                                <label class="custom-control-label" for="paypal">Paypal
                                    <img class="ml-15" src="img/core-img/paypal.png" alt="">
                                </label>
                            </div>


                        </div>

                        <div class="mt-50">
                            <label for="coupon">Coupon:</label>
                            <input name="discount_code" id="coupon" type="text" class="form-control"
                                placeholder="Enter coupon">
                        </div>

                        <div class="cart-btn mt-4">
                            <button id="btn-checkout" class="btn amado-btn w-100">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection