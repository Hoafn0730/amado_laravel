@extends('layouts.app')

@section('content')
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="cart-title mt-50">
                    <h2>Giỏ hàng</h2>
                </div>

                <div class="cart-table clearfix">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Price</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart->items as $item)
                            <tr>
                                <td class="cart_product_img">
                                    <a href="#"><img src="{{$item->image}}" alt="Product"></a>
                                </td>
                                <td class="cart_product_desc">
                                    <h5>{{$item->name}}</h5>
                                </td>
                                <td class="price">
                                    <span>{{$item->price}}đ</span>
                                </td>
                                <td class="qty d-flex">
                                    <div class="qty-btn d-flex">
                                        <div class="quantity">
                                            <span class="qty-minus" onclick="changeQuantity(-1)">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </span>
                                            <form name="form-update-quantity"
                                                action="{{route('cart.update', $item->id)}}" method="get">
                                                <input type="number" class="qty-text" id="quantity" step="1" min="1"
                                                    max="300" name="quantity" value="{{$item->quantity}}">
                                            </form>
                                            <span class="qty-plus" onclick="changeQuantity(1)">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="{{route('cart.delete', $item->id)}}"
                                        class="btn btn-danger text-light ml-3">&times;</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>


                <button class="btn btn-primary" id='btn-update'>
                    Cập nhật
                </button>

            </div>
            <div class="col-12 col-lg-4">
                <div class="cart-summary">
                    <h5>Cart Total</h5>
                    <ul class="summary-table">
                        <li><span>subtotal:</span> <span>{{$cart->totalPrice}}đ</span></li>
                        <li><span>delivery:</span> <span>Free</span></li>
                        <li><span>total:</span> <span>{{$cart->totalPrice}}đ</span></li>
                    </ul>
                    <div class="cart-btn mt-100">
                        <a href="/checkout" class="btn amado-btn w-100">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const formUpdateQuantity = document.forms['form-update-quantity'];
const quantity = document.querySelector('#quantity')
const btnUpdate = document.getElementById('btn-update')

function changeQuantity(number) {
    if (number === 1) {
        if (quantity.value < 0) {
            quantity.value = 0
        }
        quantity.value++;
    } else if (number === -1) {
        if (+quantity.value > 0) {
            quantity.value--;
        } else {
            quantity.value = 0;
        }
    }
}

btnUpdate.onclick = () => {
    formUpdateQuantity.submit()
}
</script>
@endsection