@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>مشتریان در انتظار تایید</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="panel panel-body">
            <table class="table table-striped table-bordered table-hover datatable" id="dataTables-example">
                <thead>
                <tr>
                    <th>کد کاربری</th>
                    <th>تصویر مشتری</th>
                    <th>نام مشتری</th>
                    <th>شماره تماس</th>
                    <th>ایمیل</th>
                    <th>تاریخ عضویت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>@if($customer->avatar) <img style="width: 100px;height: 100px"
                                                        src="{{ asset($customer->avatar) }}"
                                                        class="img-responsive img-circle"/> @else ندارد @endif</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->profile->phone }} - {{ $customer->profile->telephone }}</td>
                        <td>{{ $customer->email }}
                        </td>
                        <td>{{ jdate(strtotime($customer->created_at))->format('H:i | Y/m/d') }}</td>
                        <td style="width: 25%">
                            <div class="btn-group">
                                <a href="{{ route('customers.show',[$customer->id]) }}" class="btn btn-success btn-sm">
                                    ویرایش اطلاعات مشتری
                                </a>
                                <a href="{{ route('admin.customers.deleteCustomer',[$customer->id]) }}" class="btn btn-danger btn-sm deleteBTN">حذف مشتری</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
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