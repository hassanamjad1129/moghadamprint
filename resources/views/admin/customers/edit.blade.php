@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>مشخصات مشتری {{ $user->name }}</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <form action="{{ route('customers.update',[$user->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="box-body">
                    <div class="col-md-9">
                        <div class="col-md-6" style="padding: 0">
                            <label for="id">کد کاربری</label>
                            <input type="text" name="id" id="id" class="form-control"
                                   value="{{ $user->id }}"/>
                        </div>

                        <div class="col-md-6" style="padding: 0">
                            <label for="name">نام و نام خانوادگی</label>
                            <input type="text" name="name" id="name" class="form-control"
                                   value="{{ $user->name }}"/>
                        </div>
                        <div class="col-md-6" style="padding: 0">
                            <label for="email">پست الکترونیکی</label>
                            <input type="text" name="email" id="email" class="form-control"
                                   value="{{ $user->email }}">
                        </div>
                        <div class="col-md-6" style="padding: 0">
                            <label for="email">جنسیت</label>
                            <div class="clearfix"></div>

                            <input type="radio" name="gender" id="male"
                                   value="male" {{ $user->profile->gender=='male'?"checked":"" }}/>
                            <label for="male">آقا</label>

                            <input type="radio" name="gender" id="female"
                                   value="female" {{ $user->profile->gender=='female'?"checked":"" }}/>
                            <label for="female">خانم</label>
                        </div>
                        <div class="clearfix"></div>
                        <label for="password">رمز عبور جدید</label>
                        <input type="password" name="password" id="password" class="form-control"/>
                        <label for="password_confirmation">تکرار رمز عبور جدید</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="form-control"/>
                    </div>
                    <div class="col-md-3">
                        <img src="{{ $user->avatar?asset($user->avatar):"/adminAsset/img/avatar.png" }}"
                             class="img-responsive img-circle">
                        <input type="file" name="picture" id="" class="form-control"/>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-md-6">
                        <label for="">شماره همراه</label>
                        <input type="text" name="phone" value="{{ $user->profile->phone }}" id="" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="">شماره تماس ضروری</label>
                        <input type="text" name="telephone" value="{{ $user->profile->telephone }}" id=""
                               class="form-control">
                    </div>

                    <div class="col-md-12" >
                        <label for="">کد معرف</label>
                        <input type="text" name="reagent" value="{{ $user->profile->reagent }}" id=""
                               class="form-control">
                    </div>

                    <div class="col-md-12">
                        <label for="">آدرس</label>
                        <textarea name="address" class="form-control" id="" cols="30"
                                  rows="4">{{ $user->profile->address }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-success" style="margin-top: 5px">بروزرسانی</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection