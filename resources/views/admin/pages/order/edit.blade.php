@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Quản lý hóa đơn</h1>

    <div class="row d-flex align-items-center justify-content-between">
        <div class="col-6">
            <div class='card shadow'>
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sửa hóa đơn</h6>
                </div>
                <div class='card-body'>
                    @if ($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif
                    <form name='form-order' action='{{route("orders.update", ["order" => $order])}}' method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">

                            <label for="exampleInputPassword1">Người dùng:</label>
                            <select name="user_id" aria-controls="dataTable"
                                class="custom-select custom-select-sm form-control form-control-sm">
                                <option selected disabled>-- Chọn người dùng --</option>
                                @foreach($users as $user)
                                @if ($user->id === $order->user_id)
                                <option value="{{$user->id}}" selected>{{$user->name}}</option>
                                @else
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa chỉ:</label>
                            <input value="{{$order->address}}" type="text" name='address' class="form-control"
                                id="exampleInputEmail1">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Số điện thoại:</label>
                            <input value="{{$order->phone}}" type="text" name='phone' class="form-control"
                                id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tên trên thẻ:</label>
                            <input value="{{$order->name_on_card}}" type="text" name='name_on_card' class="form-control"
                                id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mã giảm giá:</label>
                            <input value="{{$order->discount_code}}" type="text" name='discount_code'
                                class="form-control" id="exampleInputPassword1">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Phương thức thanh toán:</label>
                            <input value="{{$order->payment_gateway}}" type="text" name='payment_gateway'
                                class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái:</label>
                            <select name="shipped" aria-controls="dataTable"
                                class="custom-select custom-select-sm form-control form-control-sm">
                                <option selected disabled>-- Chọn Trạng thái --</option>
                                <option value="0">Chưa giao</option>
                                <option value="1">Đã giao</option>

                            </select>
                        </div>

                        <button id='btn-update' type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection