@extends('customer.layouts.master') @section('content')
    <style>
        .orderProperties td {
            width: 50%;
        }

        .orderProperties tr td:first-child {
            font-weight: bold;
        }
    </style>
    <h3 class="text-center" style="margin-bottom: 25px">جزییات سفارش به شماره فاکتور {{ $order->id }}</h3>
    <div class="col-md-6 orderProperties">
        <div class="panel panel-success">
            <div class="panel-heading">
                <i class="fa fa-truck"></i> جزییات سفارش
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <td>دسته بندی محصول</td>
                        <td>{{ $order->product->subcategory->category->name }}</td>
                    </tr>
                    <tr>
                        <td>نوع جنس</td>
                        <td>{{ $order->product->subcategory->name }}</td>
                    </tr>
                    <tr>
                        <td>ابعاد</td>
                        <td>{{ $order->product->name }}</td>
                    </tr>
                    <tr>
                        <td>سرعت چاپ</td>
                        <td>{{ $order->speed=="fast"?"فوری":"عادی" }}</td>
                    </tr>

                    <tr>
                        <td>نوع کار</td>
                        <td>{{ $order->type=="single"?"یک رو":"دو رو" }}</td>
                    </tr>
                    <tr>
                        <td>لت</td>
                        <td>{{ $order->lats }}</td>
                    </tr>

                    <tr>
                        <td>سری</td>
                        <td>{{ $order->qty }}</td>
                    </tr>

                    <tr>
                        <td>وضعیت سفارش</td>
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
                                case 8:
                                    echo "تحویل نهایی";
                                    break;
                                case 9:
                                    echo "در انتظار باربری";
                                    break;
                                case 10:
                                    echo "تحویل باربری";
                                    break;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>تاریخ ثبت سفارش</td>
                        <td>{{ jdate(strtotime($order->created_at))->format("H:i | Y/m/d") }}</td>
                    </tr>
                  <tr>
                        <td>توضیحات سفارش</td>
                        <td>{{ ($order->description) }}</td>
                    </tr>
                </table>
                <hr>
                <p>خدمات پس از چاپ</p>
                @if($order->itemServices) @foreach($order->itemServices as $service)
                    <p>{{ $service->service->name }} : {{ $service->qty }} عدد <br>توضیحات
                        : {{ $service->description?$service->description:"ندارد" }}
                    <hr></p>
                @endforeach @endif
            </div>
        </div>
    </div>
    <div class="col-md-6 orderProperties">
        <div class="panel panel-success">
            <div class="panel-heading">
                مشخصات ارسال
            </div>
            <div class="panel-body">
                <label for="">آدرس ارسال</label>
                <br> {{ $order->order->delivery_address }}
                @if($order->order->delivery_address!="تحویل در چاپخانه")
                    <br>
                    <label for="">شهر یا استان</label>
                    <p>{{ $order->delivery_state }}</p>
                    <label for="">شماره بارنامه</label>
                    <p>{{ $order->delivery_number }}</p>
                    <label for="">باربری ارسالی</label>
                    <p>{{ $order->delivery_sender }}</p>
                    <label for="">شماره تماس و محل تحویل بار</label>
                    <p>{{ $order->delivery_location }}</p>
                @endif
            </div>
        </div>

        <div class="panel panel-success">
            <div class="panel-heading">
                مشخصات پرداخت
            </div>
            <div class="panel-body">
                <label for="">قیمت واحد</label>
                <p>{{ number_format($order->unit_price) }} ریال</p>

                <label for="">خدمات</label>
                <p>
                    <?php
                    $price = 0;
                    if ($order->itemServices->count())
                        foreach ($order->itemServices as $service) {
                            $price += $service->price * $order->lats * $order->qty;
                        }
                    echo number_format($price) . ' ریال';
                    ?>
                </p>

                <label for="">قیمت کل</label>
                <p>{{ number_format($order->unit_price*$order->qty*$order->lats+ $price) }} ریال</p>

                <label for="">نوع پرداخت</label>
                <br> {{ $order->payment=='online'?"درگاه اینترنتی":"کیف پول" }}
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                فایل های ارسالی
            </div>
            <div class="panel-body">
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4 class="text-center">
                                فایل های روی سفارش
                            </h4>
                        </div>
                        <div class="panel-body">
                            @foreach($order->files as $file)
                                <label for="" class="text-center" style="width: 100%">
                                    <h4>{{ $file->myFile->front_file_label }}</h4></label>
                                <img src="{{ asset($file->front) }}" alt="" class="img-responsive">
                                <hr> @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4 class="text-center">
                                فایل های پشت سفارش
                            </h4>
                        </div>
                        <div class="panel-body">
                            @foreach($order->files as $file)
                                <label for="" class="text-center" style="width: 100%">
                                    <h4>{{ $file->myFile->back_file_label }}</h4></label>
                                <img src="{{ asset($file->back) }}" alt="" class="img-responsive">
                                <hr> @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection