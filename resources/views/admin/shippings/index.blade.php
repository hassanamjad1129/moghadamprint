@extends('admin.layouts.master')
@section('extraStyle')
    <link rel="stylesheet" href="/adminAsset/datatables/dataTables.bootstrap.css">
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h2>روش ارسال سفارشات</h2>
            </div><!-- /.box-header -->
            <div class="box-body">

                <table class="table table-bordered table-hover dataTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>عنوان روش</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    @foreach($shippings as $shipping)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $shipping->name }}</td>
                            <td>{{ $shipping->status?"غیرفعال":"فعال" }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('shippings.edit',[$shipping->id]) }}" class="btn btn-warning">ویرایش
                                        اطلاعات</a>
                                    @if(!$shipping->status)
                                        <form action="{{ route('shippings.destroy',[$shipping->id]) }}" method="post"
                                              style="display: inline">
                                            @csrf
                                            @method('delete')

                                            <button class="btn btn-danger"
                                                    style="border-bottom-right-radius: 0;border-top-right-radius: 0;">
                                                حذف
                                                روش
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('shippings.restore',[$shipping->id]) }}"
                                           class="btn btn-danger">بازگردانی روش</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
@section('extraScripts')
    <script src="/adminAsset/datatables/jquery.dataTables.min.js"></script>
    <script src="/adminAsset/datatables/dataTables.bootstrap.min.js"></script>

    <script>
        $("table").dataTable();
    </script>
@endsection
