@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Quản lý sản phẩm</h1>

    <div class="row d-flex align-items-center justify-content-between">
        <div class="col-6">
            <div class='card shadow'>
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sửa sản phẩm</h6>
                </div>
                <div class='card-body'>
                    @if ($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif
                    <form name='form-product' action='{{route("products.update", ["product" => $product])}}'
                        method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm:</label>
                            <input value='{{$product->name}}' type="text" name='name' class="form-control"
                                id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Chi tiết:</label>
                            <input value='{{$product->details}}' type="text" name='details' class="form-control"
                                id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Giá:</label>
                            <input value='{{$product->price}}' type="number" name='price' class="form-control"
                                id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Ảnh:</label>
                            <input value='{{$product->image}}' type="text" name='image' class="form-control"
                                id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số lượng:</label>
                            <input value='{{$product->quantity}}' type="number" name='quantity' class="form-control"
                                id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả:</label>
                            <textarea type="number" name='description' class="form-control"
                                id="exampleInputPassword1">{{$product->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thể loại:</label>
                            <select value='{{$product->category_id}}' name="category_id" aria-controls="dataTable"
                                class="custom-select custom-select-sm form-control form-control-sm">
                                <option selected disabled>-- Chọn thể loại --</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
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