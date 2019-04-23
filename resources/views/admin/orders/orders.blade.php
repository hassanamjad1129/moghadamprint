@extends('admin.layouts.master')
@section('content')
<section class="content">
    <h3 class="text-center" style="margin-bottom: 20px">آرشیو سفارشات</h3>
    <div class="col-md-12 box" style="padding:5px">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th style="width: 90px">شماره فاکتور</th>
                <th>شماره پیگیری(توسط ادمین)</th>
                <th>تاریخ ثبت سفارش</th>
                <th>نام مشتری</th>
                <th>دسته بندی محصول</th>
                <th>نوع جنس</th>
                <th>ابعاد</th>
                <th>فایل رو</th>
                <th>فایل پشت</th>
                <th>سرعت چاپ</th>
                <th>نوع کار</th>
                <th>خدمات</th>
                <th>قیمت نهایی</th>
                <th>وضعیت</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1 ?>
            @foreach($orders as $order)
                <?php
                ?>
                <tr>
                    <td>{{ $order->id }}</td>
                    <td><span style="color:red">{{ $order->tracking_code }}</span></td>
                    <td>{{ jdate(strtotime($order->created_at))->format('H:i | Y/m/d') }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->product->subcategory->category->name }}</td>
                    <td>{{ $order->product->subcategory->name }}</td>
                    <td>{{ $order->product->name }}</td>
                    <td>
                        @foreach($order->files as $file)
                      <?php
                      $imgAddress=explode('/',$file->front);
                      $imgAddress[count($imgAddress)-1]='test-'.$imgAddress[count($imgAddress)-1];
                      $front=implode('/',$imgAddress)
                      ?>
                            <img src="{{ asset($front) }}" style="width: 120px" alt="">
                            <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($order->files as $file)
                      <?php
                      $imgAddress=explode('/',$file->back);
                      $imgAddress[count($imgAddress)-1]='test-'.$imgAddress[count($imgAddress)-1];
                      $back=implode('/',$imgAddress)
                      ?>
                      
                      <img src="{{ asset($back) }}" style="width:120px" alt="">
                            <br>
                        @endforeach
                    </td>
                    <td>{{ $order->speed=="fast"?"فوری":"عادی" }}</td>
                    <td>{{ $order->type=="single"?"یک رو":"دو رو" }}</td>
                    <td>
                  <?php
                        $price=0;
                        if($order->itemServices->count())
                          foreach($order->itemServices as $service){
                            $price+=$service->price*(($order->lats*$order->qty*$order->product->subcategory->circulation)/$service->service->capacity)*$order->lats*$order->qty;
                          }
                        echo number_format($price).' ریال';
                      ?>
                    </td>
                    <td>{{ number_format($order->unit_price*$order->lats*$order->qty+$price) }} ریال</td>
                    <td>
                        <span class="badge badge-success">آماده تحویل </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.order.detail',[$order->id]) }}" class="btn btn-success">مشاهده جزییات</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
      <div class="clearfix"></div>

</section>
<div class="clearfix"></div>
@endsection