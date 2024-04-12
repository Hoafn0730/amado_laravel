@extends('layouts.app')

@section('content')
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="cart-title mt-50">
                    <h2>Danh sách hóa đơn</h2>
                </div>

                <div class="cart-table clearfix">
                    <table id="invoice" class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Thông tin liên hệ</th>
                                <th>Sản phẩm</th>
                                <th>Tổng tiền</th>
                                <th>Phương thức thanh toán</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr data-id="{{$order->id}}">
                                <td class="d-flex">
                                    <span class="mr-3">{{$loop->index + 1}}</span>
                                    <h5>{{$order->user_name}}</h5>
                                </td>
                                <td>
                                    <span>{{$order->address}} ({{$order->phone}})</span>
                                </td>
                                <td>
                                    <span>
                                        @php
                                        $products = json_decode($order->products);
                                        @endphp

                                        @if (is_array($products) && count($products) > 0)
                                        @foreach (json_decode($order->products) as $product)
                                        {{ $product->product_name }} x{{ $product->quantity }}<br>
                                        @endforeach
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <span>{{$order->total}}đ</span>
                                </td>
                                <td>
                                    <span>{{$order->payment_gateway}}</span>
                                </td>
                                <td>
                                    <span>{{$order->shipped ? 'Đã giao' : 'Chưa giao'}}</span>
                                </td>
                                <td>
                                    <span>{{$order->created_at}}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>

</div>



<script>
const invoice = document.getElementById('invoice');
const rows = invoice.querySelectorAll('tbody tr');
rows.forEach(row => {
    row.onclick = () => {
        const id = row.dataset.id;
        console.log(id);
    }
})
</script>

@endsection