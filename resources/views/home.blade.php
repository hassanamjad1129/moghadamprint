@extends('layouts.app')

@section('content')
    <div class="container" style="padding: 0;">

        <div id="loginSection" style="width: 100%; margin-top: 1rem">
            <div id="signUpSection">
                <div class="ribbon-4">
                    <div class="ribbon-content">
                        <p class="ribbonTitleInner">
                            مجموعه تبلیغاتی مقدم
                        </p>
                    </div>
                </div>
                @if(auth()->user()->active==0)
                <h4 class="notation">حساب کاربری شما با موفقیت ایجاد شد . پس از تایید مدیریت مجموعه تبلیغاتی مقدم می توانید اقدام به ثبت سفارش کنید.</h4>
                @else
                <h4 class="notation">برای ورود به پنل کاربری <a href="{{ auth()->user()->level=='admin'?url('/admin'):route('customerDashboard') }}">اینجا</a> کلیک کنید</h4>
                @endif
          </div>
        </div>
    </div>
@endsection
