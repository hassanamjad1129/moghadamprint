@extends('admin.layouts.master')
@section('extraStyle')
    <link rel="stylesheet" href="/adminAsset/datatables/dataTables.bootstrap.css">
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h2>دسته بندی محصولات</h2>
            </div><!-- /.box-header -->
            <div class="box-body">

                <table class="table table-bordered table-hover dataTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>عنوان دسته بندی</th>
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
                                    <a href="{{ route('categories.edit',[$category->id]) }}" class="btn btn-warning">ویرایش
                                        اطلاعات</a>
                                    <a href="{{ route('categories.show',[$category->id]) }}" class="btn btn-primary">نمایش
                                        اطلاعات</a>
                                    @if($category->deletable)
                                        <form action="{{ route('categories.destroy',[$category->id]) }}" method="post"
                                              style="display: inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger"
                                                    style="border-bottom-right-radius: 0;border-top-right-radius: 0;">
                                                حذف
                                                دسته بندی
                                            </button>
                                        </form>
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
