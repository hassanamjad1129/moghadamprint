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
    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@1.1.5/dist/css/persian-datepicker.min.css">

    <h3 class="text-center" style="margin-bottom: 20px">آرشیو سفارشات</h3>
    <div class="col-md-12">
        <div class="col-md-12" style="margin-bottom: 3rem">
            <form action="" method="post">
                @csrf
                <div class="col-md-4 ">
                    <label for="">تاریخ شروع: </label>
                    <input type="text" name="start" value="{{ request('start')?request('start'):"" }}"
                           class="form-control example1">
                </div>
                <div class="col-md-4 col-md-offset-2">
                    <label for="">تاریخ پایان: </label>
                    <input type="text" name="end" value="{{ request('end')?request('end'):"" }}"
                           class="form-control example1">
                </div>
                <div class="col-md-2">
                    <br>
                    <button class="btn btn-success">گزارش گیری</button>
                </div>
            </form>
        </div>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
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
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1;
            $sum = 0;?>
            @foreach($orders as $order)
                <?php
                ?>
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ jdate(strtotime($order->created_at))->format('H:i | Y/m/d') }}</td>
                    <td>{{ $order->product->subcategory->category->name }}</td>
                    <td>{{ $order->product->subcategory->name }}</td>
                    <td>{{ $order->product->name }}</td>
                    <td>
                        @foreach($order->files as $file)
                            <?php
                            $imgAddress = explode('/', $file->front);
                            $imgAddress[count($imgAddress) - 1] = 'test-' . $imgAddress[count($imgAddress) - 1];
                            $front = implode('/', $imgAddress)
                            ?>
                            <img src="{{ asset($front) }}" style="width: 120px" alt="">
                            <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($order->files as $file)
                            <?php
                            $imgAddress = explode('/', $file->back);
                            $imgAddress[count($imgAddress) - 1] = 'test-' . $imgAddress[count($imgAddress) - 1];
                            $back = implode('/', $imgAddress)
                            ?>

                            <img src="{{ asset($back) }}" style="width:120px" alt="">
                            <br>
                        @endforeach
                    </td>

                    <td>{{ $order->speed=="fast"?"فوری":"عادی" }}</td>
                    <td>{{ $order->type=="single"?"یک رو":"دو رو" }}</td>
                    <td><?php
                        $price = 0;
                        if ($order->itemServices->count())
                            foreach ($order->itemServices as $service) {
                                $price += $service->price * (($order->lats * $order->qty * $order->product->subcategory->circulation) / $service->service->capacity) * $order->lats * $order->qty;
                            }
                        echo number_format($price) . ' ریال';
                        ?></td>
                    <?php $sum += (($order->unit_price - $order->discount) * $order->qty * $order->lats); ?>

                    <td>{{ number_format($order->unit_price*$order->lats*$order->qty+$price) }} ریال</td>
                    <td>
                        <span class="badge badge-success">آماده تحویل </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('customer.order.detail',[$order->id]) }}" class="btn btn-success">مشاهده
                                جزییات</a>
                            <a href="{{ route('customer.orders.getFactor',[$order->id]) }}" class="btn btn-primary">مشاهده
                                فاکتور</a>

                        </div>
                    </td>
                </tr>
                <?php $i++; ?>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th colspan="2">مجموع خرید : {{ $i . " سفارش" }}</th>
                <th colspan="3">{{ number_format($sum).' ریال' }}</th>
                <th colspan="3">مجموع بدهی</th>
                <th colspan="3">مجموع بدهی : {{ number_format(auth()->user()->profile->debt) }} ریال</th>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection
@section('extraScripts')
    <script src="https://unpkg.com/persian-date@1.0.5/dist/persian-date.min.js"></script>
    <script src="https://unpkg.com/persian-datepicker@1.1.5/dist/js/persian-datepicker.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".example1").pDatepicker({
                format: 'YYYY/MM/DD',
                initialValueType: 'persian'
            });
        });
    </script>
@endsection