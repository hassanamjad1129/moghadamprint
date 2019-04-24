@extends('customer.layouts.master')
@section('content')
    <style>
        .info {
            background: rgba(0, 0, 0, .15);
            border: 2px solid rgba(0, 0, 0, .3);
            padding: 5px 15px;
        }


    </style>
    <section class="content col-md-12">
        <div class="container">
            <div class="box">
                <div class="col-xs-12">
                    <h2>فاکتور فروش</h2>
                    <img src="/factor-header.png" style="width: 100%" alt="">
                    <div class="col-xs-8">
                        <h4>شماره فاکتور :{{ $orderItem->id }}</h4>
                    </div>
                    <div class="col-xs-4">
                        <h4>تاریخ : {{ jdate(strtotime($orderItem->created_at))->format('Y/m/d') }}</h4>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-xs-12">
                        <div class="info">
                            <div class="row">
                                <div class="col-xs-12"><h4>مشتری : {{ auth()->user()->name }}</h4></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6"><h5>شماره تلفن : {{ auth()->user()->profile->telephone }}</h5>
                                </div>
                                <div class="col-xs-6"><h5>شمراه همراه :{{ auth()->user()->profile->phone }}</h5></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-xs-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>نوع سفارش</th>
                                <th>تیراژ</th>
                                <th>قیمت واحد (ریال)</th>
                                <th>مبلغ (ریال)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ $orderItem->product->subcategory->category->name." ".$orderItem->product->subcategory->name." ".$orderItem->product->name }}</td>
                                <td>{{ $orderItem->product->subcategory->circulation."*".($orderItem->qty*$orderItem->lats) }}</td>
                                <td>{{ number_format($orderItem->unit_price) }} ریال</td>
                                <td>{{ number_format($orderItem->unit_price*$orderItem->lats*$orderItem->qty) }}ریال
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <p>توضیحات : </p>
                        <ol>
                            <li>غلط املایی بر عهده مشتری می باشد.لطفا در هنگام سفارش دقت فرمایید.</li>
                            <li>در هنگام تحویل سفارش تسویه کامل انجام میشود ، در غیر اینصورت از تحویل محصول معذوریم</li>
                            <li>اعتبار این فاکتور از تاریخ فوق به مدت 15 روز می باشد.</li>
                            <li>فقط در صورت تسویه کامل و یا پیش پرداخت فرایند چاپ صورت میگیرد.</li>
                            <li>ایام تعطیل شامل روز کاری نمی باشد.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection