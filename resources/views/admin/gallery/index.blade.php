@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>گالری</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-heading">
                <h2>گالری</h2>
                <a href="{{ route('admin.gallery.create') }}" class="btn btn-success">افزودن فایل</a>
            </div>
            <div class="box-body">
                <table class="table table-striped table-hover table-bordereddatatable" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>تصویر</th>
                        <th>دسته بندی</th>
                        <th>تاریخ درج</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    @foreach($galleries as $gallery)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><img src="{{ asset($gallery->picture) }}" class="img-responsive img-thumbnail" style="width: 200px" alt="">
                            </td>
                            <td>{{ $gallery->category->name }}</td>
                            <td>{{ jdate(strtotime($gallery->created_at))->format("H:i | Y/m/d") }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.gallery.edit',[$gallery->id]) }}" class="btn btn-warning">ویرایش</a>
                                      <a href="{{ route('admin.gallery.destroy',[$gallery->id]) }}" class="btn btn-danger">حذف</a>
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