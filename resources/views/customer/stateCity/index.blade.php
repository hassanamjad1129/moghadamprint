@extends('customer.layouts.master')
@section('content')

<style>
        .badge-warning {
            color: #000;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            background-color: #e0ce00;
        }

        .table tr {
            transition: all 0.4s ease;
        }

        .table th {
            color: #fff;
            font-family: Yekan;
            font-weight: normal;
            background-color: #66BB6A !important;
            text-align: center;
        }

        .table td {
            font-family: yekan;
            direction: rtl;
            text-align: center;
            vertical-align: middle;
        }

        .table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
            border: 2px solid #66bb6a;
            vertical-align: middle;
        }

    </style>

<h3 class="text-center" style="margin-bottom: 20px">ارسال سفارش به شهرستان</h3>
<div class="body-wrapper">     
    <div id="content" class="site-content">
      <form action="{{route('customer.orderStateCity.store')}}" method="post">
        @csrf
        <div class="col-md-12">
          <label for="state">انتخاب استان</label>
          <select required name="state" id="state" class="form-control" onchange="cityAjax(this.value)">
            <option value="">استان را انتخاب کنید...</option>
            @foreach($states as $state)
              <option value="{{$state->id}}">{{$state->name}}</option>
            @endforeach
          </select>
          <br>
        </div>
        <div class="col-md-12">
          <label for="city">انتخاب شهر</label>
          <select required id="city" name="city" class="form-control" onchange="sendMethodAjax(this.value)">
            <option value="">شهر را انتخاب کنید...</option>
          </select>
          <br>
        </div>
        <div class="col-md-12">
          <label for="sendMethod">انتخاب باربری</label>
          <select required id="sendMethod" name="sendMethod" class="form-control">
            <option value="">انتخاب باربری ...</option>
            @foreach($sendMethods as $sendMethod)
              <option value="{{$sendMethod->id}}">{{$sendMethod->name}}</option>
            @endforeach
          </select>
          <br>
        </div>
        <span style="font-size:18px">انتخاب سفارش</span>
        <div class="col-xs-12" style="border:1px solid #ccc; max-height:500px;overflow-y:scroll">
          <div class="col-md-12">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>انتخاب</th>
                <th style="width: 90px">شماره فاکتور</th>
                <th>تاریخ ثبت سفارش</th>
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
            </tr>
            </thead>
            <tbody>
            <?php $i = 1 ?>
            @foreach($orderItems as $order)
                <?php
                ?>
                <tr>
                  <td>
                        <div class="btn-group">
                          <label for="{{$order->id}}">انتخاب</label>
                            <input type="checkbox" name="sendCode[]" id="{{$order->id}}" value="{{$order->id}}">
                        </div>
                    </td>
                    <td>{{ $order->id }}</td>
                    <td>{{ jdate(strtotime($order->created_at))->format('H:i | Y/m/d') }}</td>
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
                    <td><?php
                        $price=0;
                        if($order->itemServices->count())
                          foreach($order->itemServices as $service){
                            $price+=$service->price*(($order->lats*$order->qty*$order->product->subcategory->circulation)/$service->service->capacity)*$order->lats*$order->qty;
                          }
                        echo number_format($price).' ریال';
                      ?></td>
                    <td>{{ number_format($order->unit_price*$order->lats*$order->qty+$price) }} ریال</td>
                    <td>
                        <span class="badge badge-success">آماده تحویل </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
        </div>
        <div class="col-md-12">
          <label for="description">توضیحات سفارش</label>
          <textarea class="form-control" name="description" id="description" placeholder="توضیحات سفارش"></textarea>
          <br>
        </div>
        <div>
          <button class="btn btn-success">
            ثبت سفارش
          </button>
        </div>
      </form>
    </div>
</div>
<script>
 function cityAjax(val){
    $.ajax({
          url: "{{ route('customer.city.ajax') }}",
          method: 'post',
          data: {state: val},
          success: function(result){
            $("#city").html('<option value="">شهر را انتخاب کنید...</option>');
            for (let i=0; i<result.length; i++) {
              $("#city").append($(new Option(result[i].name,result[i].id)));
            }
    }});
  }
</script>
@endsection