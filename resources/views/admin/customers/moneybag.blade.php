@extends('admin.layouts.master')
@section('content')
<style>
    @media print{
        form{
            display:none;
        }
        .content-header h3{
            display:inline;
        }
    }
    @media screen{
       .content h3{
           display:none;
       } 
    }
</style>

    <section class="content-header">
         <h3>کیف پول مشتری {{ $customer->name }}- موجودی : <span
                    style="color:#ff4444">{{ number_format($customer->profile->money_bag) }}</span> ریال - اعتبار هدیه :
            <span style="color:#ff4444">{{ number_format($customer->profile->gift_money_bag) }}</span> ریال -
            اعتبار مجتمع : <span style="color:#ff4444">{{ number_format($customer->profile->complex_money_bag) }}</span> ریال
        - <span>بدهی : <span style="color:#ff4444">{{ number_format($customer->profile->debt) }}</span> ریال</span></h3>
    </section>
    <!-- Main content -->
    <section class="content">
        <h3>کیف پول مشتری {{ $customer->name }}- موجودی : <span
                    style="color:#ff4444">{{ number_format($customer->profile->money_bag) }}</span> ریال - اعتبار هدیه :
            <span style="color:#ff4444">{{ number_format($customer->profile->gift_money_bag) }}</span> ریال -
            اعتبار مجتمع : <span style="color:#ff4444">{{ number_format($customer->profile->complex_money_bag) }}</span> ریال
        - <span>بدهی : <span style="color:#ff4444">{{ number_format($customer->profile->debt) }}</span> ریال</span></h3>
        <div class="panel panel-body">
            <form action="" method="post">
                @csrf
                <div class="col-md-6">
                    <label for="">مبلغ</label>
                    <input type="text" name="price" class="form-control price"/>
                </div>
                <div class="col-md-6">
                    <label for="">عملیات</label>
                    <select name="operation" id="" class="form-control">
                        <option value="increase">افزایش </option>
                        <option value="decrease">کاهش </option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="">عملیات روی :</label>
                    <select class="form-control" name="subject">
                        <option value="money_bag">کیف پول</option>
                        <option value="gift_money_bag">اعتبار هدیه</option>
                        <option value="complex_money_bag">اعتبار مجتمع</option>
                        <option value="debt">بدهی</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="">نمایش پیام</label>
                    <select name="showMessage" id="" class="form-control">
                        <option value="1">نمایش بدهد</option>
                        <option value="0">نمایش ندهد</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label for="">توضیحات</label>
                    <textarea name="description" id="" cols="30" rows="4" class="form-control"></textarea>
                </div>
                <div class="col-md-12">
                    <label for="">ارسال پیامک برای مشتری :</label>
                    <div class="clearfix"></div>
                    <input type="radio" name="sendMessage" id="sendMessage" value="1" /><label for="sendMessage" style="display: inline;margin-right: 5px">بلی</label>
                    <input type="radio" name="sendMessage" id="dontSendMessage" value="0" checked /><label for="dontSendMessage" style="display: inline;margin-right: 5px">خیر</label>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-success" style="margin-top: 10px;margin-bottom: 10px;">ثبت نهایی</button>
                </div>
            </form>
            <br>
            <hr>
            <br>
            <table class="table table-striped table-bordered table-hover datatable" id="dataTables-example">
                <thead>
                <tr>
                    <th>#</th>
                    <th>مبلغ</th>
                    <th>عملیات</th>
                    <th>توضیحات</th>
                    <th>تاریخ</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($moneybags as $moneybag)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ number_format($moneybag->price) }} ریال</td>
                        <td>{{ $moneybag->operation=='increase'?"افزایش ":"کاهش " }}</td>
                        <td>{{ $moneybag->description }}</td>
                        <td>{{ jdate(strtotime($moneybag->created_at))->format('H:i Y/m/d') }}</td>
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