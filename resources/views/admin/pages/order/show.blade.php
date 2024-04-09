@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Quản lý hóa đơn</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Bảng hóa đơn</h6>
            <button class='btn btn-primary' data-toggle="modal" data-target="#create-modal">+</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="dataTable_length">
                                <label>Hiển thị
                                    <select name="dataTable_length" aria-controls="dataTable"
                                        class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> mục
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div id="dataTable_filter" class="dataTables_filter">
                                <label>Tìm kiếm:<input type="search" class="form-control form-control-sm" placeholder=""
                                        aria-controls="dataTable">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}
                            </div>
                            @endif
                            @if ($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                            @endif
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                                role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                            rowspan="1" colspan="1" aria-sort="ascending" style="width: 156.279px;">Tên
                                            người dùng

                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" style="width: 241.279px;">Địa chỉ
                                        </th>

                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" style="width: 104.279px;">Số điện thoại
                                        </th>

                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1">Tên trên thẻ
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1">Tổng tiền
                                        </th>

                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1">Phương thức thanh toán
                                        </th>

                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1">Vận chuyển
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1">Ngày tạo
                                        </th>

                                        <th tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td class="sorting_1">{{$order->name}}</td>
                                        <td>{{$order->address}}</td>
                                        <td>{{$order->phone}}</td>
                                        <td>{{$order->name_on_card}}</td>
                                        <td>{{$order->total}}</td>
                                        <td>{{$order->payment_gateway}}</td>
                                        <td>{{$order->shipped ? 'Đã giao' : 'Chưa giao'}}</td>
                                        <td>{{$order->created_at}}</td>
                                        <td class='d-flex align-items-center'>
                                            <a href='{{route("orders.edit", $order->id)}}'
                                                class='btn btn-warning'>Sửa</a>
                                            <form method='POST' action='{{route("orders.destroy", $order->id)}}'>
                                                @csrf
                                                @method('DELETE')
                                                <button type='submit' class='btn btn-danger ml-1'>Xóa</button>
                                            </form>
                                            <button class='btn btn-info ml-1 btn-detail' style="white-space: nowrap;"
                                                data-id="{{$order->id}}" data-toggle="modal"
                                                data-target="#detail-modal">Chi tiết</button>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing
                                {{$orders->currentPage()}}
                                to 10 of {{$orders->count()}} entries</div>
                        </div>
                        <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-end">
                            <!-- pagination -->
                            {{$orders->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal create -->
    <div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm hóa đơn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name='form' action='{{route("orders.store")}}' method="POST">
                        @csrf
                        <div class="form-group">

                            <label for="exampleInputPassword1">Người dùng:</label>
                            <select name="user_id" aria-controls="dataTable"
                                class="custom-select custom-select-sm form-control form-control-sm">
                                <option selected disabled>-- Chọn người dùng --</option>
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa chỉ:</label>
                            <input type="text" name='address' class="form-control" id="exampleInputEmail1">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Số điện thoại:</label>
                            <input type="text" name='phone' class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tên trên thẻ:</label>
                            <input type="text" name='name_on_card' class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mã giảm giá:</label>
                            <input type="text" name='discount_code' class="form-control" id="exampleInputPassword1">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Phương thức thanh toán:</label>
                            <input type="text" name='payment_gateway' class="form-control" id="exampleInputPassword1">
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

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button id='btn-create' type="submit" class="btn btn-primary">Tạo</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal detail -->
    <div class="modal fade" id="detail-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết hóa đơn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="wrapper">
                        <div class="d-flex justify-content-between align-items-center my-2">
                            <div class="search d-flex">
                                <input type="text" class="search-type form-control"
                                    placeholder="Nhập mã, tên bài học..." />
                                <button class="btn btn-primary ml-1" id="btn-search">
                                    <i class="fas fas fa-search"></i>
                                </button>
                            </div>
                            <button class="btn btn-primary" id="btn-create-detail" data-toggle="modal"
                                data-target="#create-detail-modal">+</button>
                        </div>

                        <div class="list mt-3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" colspan="2">#</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Ngày tạo</th>
                                        <th scope="col" colspan="2"></th>
                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <!-- <button id='btn-create' type="submit" class="btn btn-primary">Tạo</button> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal create detail -->
    <div class="modal fade" id="create-detail-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm chi tiết hóa đơn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name='form-detail' action='/order-product' method="POST">
                        @csrf
                        <div class="form-group">

                            <label for="exampleInputPassword1">Sản phẩm:</label>
                            <select name="product_id" aria-controls="dataTable"
                                class="custom-select custom-select-sm form-control form-control-sm">
                                <option selected disabled>-- Chọn sản phẩm --</option>
                                @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->id}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Ma hoa don:</label>
                            <input type="text" id='order_id' name='order_id' class="form-control"
                                id="exampleInputPassword1">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">So luong:</label>
                            <input type="text" name='quantity' class="form-control" id="exampleInputPassword1">
                        </div>

                        <button id='btn-create' type="submit" class="btn btn-primary">Tạo</button>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <!-- <button id='btn-create' type="submit" class="btn btn-primary">Tạo</button> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const form = document.forms['form'];
const btnCreate = document.querySelector('#btn-create');

btnCreate.onclick = () => {
    form.submit();
}
</script>

<script>
const btnDetails = document.querySelectorAll('.btn-detail');
const list = document.querySelector('.list');
const table = list.querySelector('.table');

btnDetails.forEach(btn => {
    btn.onclick = (e) => {
        const orderId = e.target.dataset.id;
        document.forms['form-detail'].action = '/order-product/' + orderId;
        document.querySelector('#order_id').value = orderId;

        fetch(`/order-product/${orderId}`)
            .then(response => response.json())
            .then(data => {
                const tbody = table.querySelector('tbody');
                const htmls = data.map((item, index) => {
                    return `<tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="lessonId" />
                                    </div>
                                </td>

                                <th scope="row">
                                    ${index + 1}
                                </th>

                                <td>
                                    <section contenteditable="true" name="nameLesson" class="view">
                                        ${item.name}
                                    </section>
                                </td>

                                <td>
                                    <section contenteditable="true" name="description" class="view">
                                        ${item.quantity}
                                    </section>
                                </td>

                                <td>
                                    ${item.created_at}
                                </td>

                                <td>
                                    <button class="btn btn-danger" id="btn-delete-detail" data-id="">
                                        Xóa
                                    </button>
                                </td>
                            </tr>
                    `
                }).join('')
                tbody.innerHTML = htmls;

            })
            .catch(error => {
                console.log('Error fetching order details:', error);
            });
    }
})
</script>
@endsection