@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>زیردسته ها</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="table-responsive panel panel-default" style="padding: 15px">
            <table class="table table-striped table-bordered table-hover datatable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام زیردسته</th>
                    <th>دسته پدر</th>
                    <th>تیراژ</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <?php
                $i = 1;
                ?>
                @foreach($subCategories as $subCategory)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{!! $subCategory->name !!}</td>
                        <td>{{ $subCategory->category->name }}</td>
                        <td>{{ $subCategory->circulation }}</td>
                        <td>
                            @if($subCategory->status)
                                عادی
                            @else
                                غیر فعال
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('subCategories.edit',[$subCategory->id]) }}"
                                   class="btn btn-success btn-sm">
                                    <i class="fa fa-pencil"></i> ویرایش زیردسته
                                </a>
                                <form action="{{ route('subCategories.destroy',[$subCategory->id]) }}" method="post"
                                      style="display: inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm deleteLink"><i
                                                class="fa fa-trash"
                                                aria-hidden="true"></i> حذف زیردسته
                                    </button>
                                </form>
                                <a href="{{ route('admin.subCategory.files',[$subCategory->id]) }}"
                                   class="btn btn-warning btn-sm"><i class="fa fa-file"></i> مدیریت فایل</a>
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