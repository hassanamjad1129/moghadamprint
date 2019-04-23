@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>محصولات</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="panel panel-body table-responsive">
            <table class="table table-striped table-bordered table-hover datatable" id="dataTables-example">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام سایز</th>
                    <th> زیردسته</th>
                    <th>دسته</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <?php
                $i = 1;
                ?>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{!! $product->name !!}</td>
                        <td>{!! $product->subCategory->name !!}</td>
                        <td>{{ $product->subCategory->category->name }}</td>
                        <td>
                            @if($product->status)
                                عادی
                            @else
                                غیرفعال
                            @endif
                        </td>
                        <td><a href="{{ route('products.edit',[$product->id]) }}"
                               class="btn btn-success btn-sm"><i
                                        class="fa fa-pencil"></i></a>
                            <form action="{{ route('products.destroy',[$product->id]) }}" method="post"
                                  style="display: inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm deleteLink"><i class="fa fa-trash"
                                                                                                  aria-hidden="true"></i>
                                </button>
                            </form>
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