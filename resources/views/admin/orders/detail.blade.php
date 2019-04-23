@extends('admin.layouts.master')
@section('content')
    <style>
        .orderProperties td {
            width: 50%;
        }

        .orderProperties tr td:first-child {
            font-weight: bold;
        }
    </style>
    <section class="content">
        <h3 class="text-center" style="margin-bottom: 25px">جزییات سفارش به شماره فاکتور <span
                    style="color:red">{{ $order->id }}</span></h3>
        <form action="" method="post">
            @csrf
            <div class="col-md-12" style="margin-bottom:10px">
                <button style="float:left" class="btn btn-success">بروزرسانی</button>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-6 orderProperties">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-info-circle"></i>
                        جزییات سفارش
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-hover">
                            <tr>
                                <td>شماره سفارش</td>
                                <td><input class="form-control" placeholder="قابل مشاهده توسط ادمین"
                                           value="{{ $order->tracking_code ? $order->tracking_code :'' }}"
                                           name="tracking_code"/></td>
                            </tr>
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
                                    <select name="status" id="" class="form-control">
                                        <?php

                                        echo "<option value='0' " . ($order->status == 0 ? "selected" : "") . ">در انتظار تایید</option>";
                                        echo "<option value='1' " . ($order->status == 1 ? "selected" : "") . ">تایید مالی</option>";
                                        echo "<option value='2' " . ($order->status == 2 ? "selected" : "") . ">چیدمان</option>";
                                        echo "<option value='3' " . ($order->status == 3 ? "selected" : "") . ">فرم بندی</option>";
                                        echo "<option value='4' " . ($order->status == 4 ? "selected" : "") . ">لیتوگرافی</option>";
                                        echo "<option value='5' " . ($order->status == 5 ? "selected" : "") . ">چاپ و روکش</option>";
                                        echo "<option value='6' " . ($order->status == 6 ? "selected" : "") . ">برش و بسته بندی</option>";
                                        echo "<option value='9' " . ($order->status == 9 ? "selected" : "") . ">در انتظار باربری</option>";
                                        echo "<option value='10' " . ($order->status == 10 ? "selected" : "") . ">تحویل باربری</option>";
                                        echo "<option value='7' " . ($order->status == 7 ? "selected" : "") . ">آماده تحویل</option>";
                                        echo "<option value='8' " . ($order->status == 8 ? "selected" : "") . ">تحویل نهایی</option>";

                                        ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>نام مشتری</td>
                                <td style="color:red">{{ $order->user->name }}</td>
                            </tr>
                            <tr>
                                <td>کد کاربری مشتری</td>
                                <td style="color:red">{{ $order->user->id }}</td>
                            </tr>
                            <tr>
                                <td>شماره تماس مشتری</td>
                                <td style="color:red">{{ $order->user->profile->phone.' - '.$order->user->profile->telephone }}</td>
                            </tr>
                            <tr>
                                <td>تاریخ ثبت سفارش</td>
                                <td>{{ jdate(strtotime($order->created_at))->format("H:i | Y/m/d") }}</td>
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
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-truck"></i>
                        مشخصات ارسال
                    </div>
                    <div class="panel-body">
                        <label for="">آدرس ارسال</label>
                        <br>
                        <textarea class="form-control" name="address">{{ $order->order->delivery_address }}</textarea>
                        <label for="">شهر یا استان</label>
                        <input type="text" name="delivery_state" class="form-control"
                               value="{{ $order->delivery_state }}">
                        <label for="">شماره بارنامه</label>
                        <input type="text" name="delivery_number" class="form-control"
                               value="{{ $order->delivery_number }}">
                        <label for="">باربری ارسالی</label>
                        <input type="text" name="delivery_sender" class="form-control"
                               value="{{ $order->delivery_sender }}">
                        <label for="">شماره تماس و محل تحویل بار</label>
                        <input type="text" name="delivery_location" class="form-control"
                               value="{{ $order->delivery_location }}">
                    </div>
                </div>

                <div class="panel panel-primary">
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
                                    $price += $service->price * (($order->lats * $order->qty * $order->product->subcategory->circulation) / $service->service->capacity) * $order->lats * $order->qty;
                                }
                            echo number_format($price) . ' ریال';
                            ?>
                        </p>

                        <label for="">قیمت کل</label>
                        <p>{{ number_format($order->unit_price*$order->qty*$order->lats+$price) }} ریال</p>

                        <label for="">نوع پرداخت</label>
                        <br>
                        {{ $order->payment=='online'?"درگاه اینترنتی":"کیف پول" }}
                    </div>
                </div>
            </div>
        </form>

        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-file"></i>
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
                                    <hr>
                                @endforeach
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
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
@endsection