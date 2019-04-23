@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>فایل های زیردسته {!! $subCategory->name !!}</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <a href="{{ route('admin.subCategory.createFile',[$subCategory->id]) }}" class="btn btn-success"
           style="margin-bottom: 10px">افزودن فایل</a>
        <div class="table-responsive panel panel-default" style="padding: 15px">
            <table class="table table-striped table-bordered table-hover datatable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام فایل رو</th>
                    <th>نام فایل پشت</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <?php
                $i = 1;
                ?>
                @foreach($files as $file)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $file->front_file_label }}</td>
                        <td>{{ $file->back_file_label }}</td>
                        <td>
                            @if($file->status)
                                عادی
                            @else
                                غیر فعال
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.subCategory.editFile',[$subCategory->id,$file->id]) }}" class="btn btn-sm btn-warning">ویرایش</a>
                                <a href="{{ route('admin.subCategory.deleteFile',[$subCategory->id,$file->id]) }}" class="btn btn-sm btn-danger">حذف</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
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