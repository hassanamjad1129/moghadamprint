@extends('admin.layouts.master')
@section('content')
    <style>
        td a,td button{
            margin: 5px 0;
        }
    </style>
    <section class="content-header">
        <h2>مشتریان</h2>
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
                    <th>نوع کاربری</th>
                    <th>وضعیت</th>
                    <th>مجموع سفارش</th>
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
                        <td>
                            @if($customer->level=='customer')
                                مشتری عادی
                            @else
                                نمایندگی
                            @endif
                        </td>
                        <td>@if($customer->active==1)
                                فعال
                            @else
                                مسدود
                            @endif
                        </td>
                        <td>{{ $customer->totalOrders() }} سفارش</td>
                        <td>{{ jdate(strtotime($customer->created_at))->format('H:i | Y/m/d') }}</td>
                        <td style="width: 25%">

                            <a href="{{ route('customers.edit',[$customer->id]) }}" class="btn btn-success btn-xs">
                                ویرایش اطلاعات مشتری
                            </a>
                            <a href="{{ route('admin.customers.orders',[$customer->id]) }}"
                               class="btn btn-primary btn-xs">
                                سوابق خرید مشتری
                            </a>

                            <a href="{{ route('admin.customers.moneybag',[$customer->id]) }}"
                               class="btn btn-primary btn-xs">
                                کیف پول مشتری
                            </a>

                            @if($customer->level=='representation')
                                <a href="#" class="btn btn-primary btn-xs">
                                    سوابق فروش نمایندگی
                                </a>
                                <a href="{{ route('admin.customers.setCustomer',[$customer->id]) }}"
                                   class="btn btn-xs btn-primary">تبدیل به حساب کاربری عادی</a>
                            @else
                                <a href="{{ route('admin.customers.setRepresentation',[$customer->id]) }}"
                                   class="btn btn-xs btn-primary">تبدیل به حساب نمایندگی</a>
                            @endif
                          
                            @if($customer->profile)
                            @if($customer->profile->allow_buy)
                                <a href="{{ route('admin.customers.setRepresentation',[$customer->id]) }}"
                                   class="btn btn-xs btn-info">تبدیل به مشتری اعتباری</a>
                            @else
                                <a href="{{ route('admin.customers.setRepresentation',[$customer->id]) }}"
                                   class="btn btn-xs btn-info">تبدیل به مشتری عادی</a>
                            @endif
                          @endif
                            <a data-toggle="modal" data-target="#messageModal" onclick="putUserID({{ $customer->id }})" class="btn btn-default btn-xs">ارسال پیام به مشتری</a>
                            <a class="btn btn-primary btn-xs" href="{{ route('admin.customers.loginToUserAccount',[$customer->id]) }}">ورود به پنل کاربری</a>
                            @if($customer->active==1)
                                <form action="{{ route('customers.destroy',[$customer->id]) }}" method="post"
                                      style="display: inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-xs deleteLink">
                                        غیر فعال سازی حساب کاربری
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('admin.customers.unblock',[$customer->id]) }}"
                                   class="btn btn-danger btn-xs deleteLink">
                                    فعال سازی حساب کاربری
                                </a>
                            @endif
                            <a href="{{ route('admin.customers.deleteCustomer',[$customer]) }}" class="btn btn-danger btn-xs deleteLink">حذف مشتری</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
<div id="messageModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action="{{ route('admin.customers.sendMessage') }}" method="post">
    @csrf
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ارسال پیامک به مشتری</h4>
      </div>
      <div class="modal-body">
        <label for="">متن پیام</label>
        <textarea name="description" id="" cols="30" rows="4" class="form-control">
        </textarea>
        <input type="hidden" name="user">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">انصراف</button>        
        <button class="btn btn-success">ارسال</button>
      </div>
    </div>
</form>
  </div>
</div>
@endsection
@section('extraScripts')
    <script src="/adminAsset/datatables/jquery.dataTables.min.js"></script>
    <script src="/adminAsset/datatables/dataTables.bootstrap.min.js"></script>

    <script>
        $("table").dataTable();
        function putUserID(id){
          $("#messageModal input[name='user']").val(id);
        }
    </script>
@endsection