@extends('layouts.app')
@section('content')
    <style>
        .orderButton {
            background: #e52531;
            transition: all 1s;
            color: #FFF;
            padding: 5px 13px;
            font-size: 14px;
            border-radius: 4px;
            font-family: Yekan;
        }

        .finalOrderButton {
            color: #FFF;
            padding: 10px 10px;
            width: 100%;
            display: block;
            text-align: center;
            font-size: 18px;
            border-radius: 3px;
            background: #e52531;
            transition: all 1s;
            font-family: Yekan;
            margin-top: 10px;
            line-height: 1.3em;
        }

        .orderButton:hover {
            background: #333;
            color: #FFF;
        }

        .finalOrderButton:hover {
            background: #333;
            color: #FFF;
        }

        .order-title {
            background: #f7f8fa;
            font-family: Yekan;
            z-index: 2;
            position: relative;
            width: 160px;
        }

        .hr-class {
            position: relative;
            bottom: 30px;
            border-top: 1px solid #ccc;
        }

        .notice {
            text-align: justify;
            line-height: 1.7
        }

        .notice span {
            font-size: 16px;
            color: #333;
            font-family: Yekan;
            word-spacing: -1px;
        }

        #sunote_5ad472db437ce {
            background: #e9e9E9;
            font-family: Yekan;
            line-height: 3rem;
            border-radius: 3px;
            border: 1px solid #d0d0d0;
        }
    </style>
    <div class="container">
        <div id="loginSection" style="width: 100%; margin-top: 1rem">
            <div id="signUpSection">
                <div class="ribbon-4">
                    <div class="ribbon-content">
                        <p class="ribbonTitleInner">
                            سامانه سفارش آنلاین مجتمع تبلیغاتی مقدم
                        </p>
                    </div>
                </div>

                <div class="col-12" style="margin-top: 5rem">
                    <div class="col-md-7">
                        <h3 class="order-title">سفارش آنلاین</h3>
                        <hr class="hr-class">
                        <div id="sunote_5ad472db437ce" class="su-note su-note-style3 su-note-danger">
                            <div class="su-note-inner su-clearfix">
                                <p style="text-align: center;"><span style="font-size: 12pt; color: #000;">قابل توجه همکاران گرامی؛</span>
                                </p>
                                <p style="text-align: center;">مجتمع از چاپ سفارشاتی که نیاز به مجوز ارشاد اسلامی
                                    دارند، بدون مجوز معذور است. لذا چنانچه این سفارشات از طریق آنلاین و به دور از نظارت
                                    پرسنل ثبت شده باشند بعد از چاپ امحا و مبلغ سفارش بازگردانده نخواهد شد.</p>
                                <p style="text-align: center;"></p></div>
                        </div>
                        <br>
                        <p class="notice">
                            <span>
                                چنانچه تاکنون اقدام به «ثبت سفارش آنلاین» نکرده اید، قبل از ثبت هرگونه سفارش چاپ «راهنمای سفارش آنلاین» را مطالعه نمائید.
                            </span>
                            <br>
                            <br>
                            <a class="orderButton" href="{{ url('policies') }}">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                راهنمای سفارش
                            </a>
                        <hr>
                        <span style="font-size: 16px;color: #333;font-family: Yekan;">ثبت هرگونه سفارش به منزله قبول و پذیرفتن تمامی شرایط و قوانین مجتمع مقدم چاپ می باشد.</span>
                        <a href="{{ url('/customer/order') }}" class="finalOrderButton"><i class="fa fa-cart-arrow-down"
                                                                                  aria-hidden="true"></i> سیستم سفارش
                            آنلاین
                            <br><span style="font-size: 14px;color: #FFF">
                    جهت ورود به سیستم ثبت سفارش آنلاین کلیک کنید</span></a>
                        </p>
                    </div>
                    <div class="col-md-5">
                        <img src="{{ url('/assets/img/order.png') }}" class="img-responsive" style="width: 100%;"
                             alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection