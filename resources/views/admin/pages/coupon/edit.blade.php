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
                    <form name='form-category' action='{{route("categories.update", ["category" => $category])}}'
                        method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thể loại:</label>
                            <input value="{{$category->name}}" type="text" name='name' class="form-control"
                                id="exampleInputEmail1">

                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Ảnh:</label>
                            <input value="{{$category->image}}" type="text" name='image' class="form-control"
                                id="exampleInputPassword1">
                        </div>

                        <button id='btn-update' type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection