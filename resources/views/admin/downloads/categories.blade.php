@extends('admin.layouts.master')
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="col-md-12">
            <div class="box">
                <div class="box-heading">
                    <h4>دسته بندی فایل های دانلودی</h4>
                    <br>
                    <a class="btn btn-primary" href="{{ route('admin.downloads.createCategory') }}">افزودن دسته جدید</a>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام دسته</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.downloads.editCategory',[$category->id]) }}"
                                           class="btn btn-warning">ویرایش</a>
                                        <a href="{{ route('admin.downloads.deleteCategory',[$category->id]) }}"
                                           class="btn btn-danger">حذف</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
@endsection