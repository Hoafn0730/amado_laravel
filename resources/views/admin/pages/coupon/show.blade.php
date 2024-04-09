@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Quản lý phiếu giảm giá</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Bảng phiếu giảm giá</h6>
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
                                            rowspan="1" colspan="1" aria-sort="ascending" style="width: 156.279px;">Mã
                                            giảm giá
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" style="width: 241.279px;">Phần trăm chiết khấu
                                        </th>

                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" style="width: 104.279px;">Ngày tạo
                                        </th>

                                        <th tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                            style="width: 93.2793px;">
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($coupons as $coupon)
                                    <tr>
                                        <td class="sorting_1">{{$coupon->code}}</td>
                                        <td>{{$coupon->percent_off}}</td>
                                        <td>{{$coupon->created_at}}</td>
                                        <td class='d-flex align-items-center'>
                                            <a href='{{route("coupons.edit", $coupon->id)}}'
                                                class='btn btn-warning'>Sửa</a>
                                            <form method='POST' action='{{route("coupons.destroy", $coupon->id)}}'>
                                                @csrf
                                                @method('DELETE')
                                                <button type='submit' class='btn btn-danger ml-3'>Xóa</button>
                                            </form>
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
                                {{$coupons->currentPage()}}
                                to 10 of {{$coupons->count()}} entries</div>
                        </div>
                        <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-end">
                            <!-- pagination -->
                            {{$coupons->links()}}
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
                    <h5 class="modal-title" id="exampleModalLabel">Thêm phiếu giảm giá</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name='form' action='{{route("coupons.store")}}' method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã giảm giá:</label>
                            <input type="text" name='code' class="form-control" id="code">
                            <button type="button" id="render-code" class="btn btn-primary mt-1">Lấy code</button>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Phần trăm chiết khấu:</label>
                            <input type="number" name='percent_off' class="form-control" id="exampleInputPassword1">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button id='btn-create' type="button" class="btn btn-primary">Tạo</button>
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
const renderCode = document.querySelector('#render-code')
const code = document.querySelector('#code')
renderCode.onclick = (e) => {
    e.preventDefault()
    const codeValue = Math.floor(Math.random() * 100000000)
    code.value = codeValue;
}
</script>
@endsection