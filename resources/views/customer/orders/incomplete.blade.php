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

    <h3 class="text-center" style="margin-bottom: 20px">لیست سفارشات در حال انجام</h3>
    <div class="col-md-12">
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
            <?php $i = 1 ?>
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
                    <td>
                        <?php
                        $price = 0;
                        if ($order->itemServices->count())
                            foreach ($order->itemServices as $service) {
                                $price += $service->price * (($order->lats * $order->qty * $order->product->subcategory->circulation) / $service->service->capacity) * $order->lats * $order->qty;
                            }
                        echo number_format($price) . ' ریال';
                        ?>
                    </td>
                    <td>{{ number_format($order->unit_price*$order->lats*$order->qty+$price) }} ریال</td>
                    <td>
                        <?php
                        switch ($order->status) {
                            case 0:
                                echo "<span class='badge-danger'>در انتظار تایید</span>";
                                break;
                            case 1:
                                echo "<span class='badge'>تایید مالی</span>";
                                break;
                            case 2:
                                echo "<span class='badge'>چیدمان</span>";
                                break;
                            case 3:
                                echo "<span class='badge'>فرم بندی</span>";
                                break;
                            case 4:
                                echo "<span class='badge'>لیتوگرافی</span>";
                                break;
                            case 5:
                                echo "چاپ و روکش";
                                break;
                            case 6:
                                echo "برش و بسته بندی";
                                break;
                            case 7:
                                echo "آماده در انتظار درخواست باربری";
                                break;

                        }
                        ?>
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
            @endforeach
            </tbody>
        </table>
    </div>

@endsection