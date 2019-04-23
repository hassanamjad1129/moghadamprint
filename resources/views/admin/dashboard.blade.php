@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>داشبورد</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h4>مشخصات پروفایل کاربری</h4>
            </div>
            <div class="box-body">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="name">نام و نام خانوادگی</label>
                            <input type="text" name="name" id="name" class="form-control"
                                   value="{{ auth()->user()->name }}"/>
                            <label for="email">پست الکترونیکی</label>
                            <input type="text" name="email" id="email" class="form-control"
                                   value="{{ auth()->user()->email }}">
                            <label for="password">رمز عبور جدید</label>
                            <input type="password" name="password" id="password" class="form-control"/>
                            <label for="password_confirmation">تکرار رمز عبور جدید</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <img src="{{ auth()->user()->avatar?asset(auth()->user()->avatar):"/adminAsset/img/avatar.png" }}"
                             class="img-responsive img-circle">
                        <input type="file" name="avatar" id="" class="form-control"/>
                    </div>
                    <div class="col-xs-12">
                        <button class="btn btn-success">بروزرسانی پروفایل کاربری</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection