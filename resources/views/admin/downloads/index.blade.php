@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>فایل های دانلودی</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-heading">
                <h2>فایل های دانلودی</h2>
                <a href="{{ route('downloads.create') }}" class="btn btn-success">افزودن فایل</a>
            </div>
            <div class="box-body">
                <table class="table table-striped table-hover table-bordereddatatable" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>عنوان فایل</th>
                        <th>تصویر</th>
                        <th>دسته بندی</th>
                        <th>تاریخ درج</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    @foreach($downloads as $download)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $download->title }}</td>
                            <td><img src="{{ asset($download->icon) }}" class="img-responsive img-thumbnail" style="width: 200px" alt="">
                            </td>
                            <td>{{ $download->category->name }}</td>
                            <td>{{ jdate(strtotime($download->created_at))->format("H:i | Y/m/d") }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('downloads.edit',[$download->id]) }}" class="btn btn-warning">ویرایش</a>
                                    <form action="{{ route('downloads.destroy',[$download->id]) }}" method="post"
                                          style="display: inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger">حذف</button>
                                    </form>
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