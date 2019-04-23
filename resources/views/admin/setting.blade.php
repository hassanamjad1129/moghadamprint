@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>تنظیمات وبسایت</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="" method="post">
            @csrf
            <div class="col-md-4">
                <div class="box form-group">
                    <div class="box-header">
                        <label for="">شماره تلفن</label>
                    </div>
                    <div class="box-body">
                        <input type="text" name="telephone" value="{{ $telephone }}" id="" class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box form-group">
                    <div class="box-header">
                        <label for="">پست الکترونیکی</label>
                    </div>
                    <div class="box-body">
                        <input type="text" name="email" value="{{ $email }}" id="" class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box form-group">
                    <div class="box-header">
                        <label for="">آدرس</label>
                    </div>
                    <div class="box-body">
                        <input type="text" name="address" value="{{ $address }}" id="" class="form-control"/>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="box form-group">
                    <div class="box-header">
                        <label for="">اینستاگرام</label>
                    </div>
                    <div class="box-body">
                        <input type="text" name="instagram" value="{{ $instagram }}" id="" class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box form-group">
                    <div class="box-header">
                        <label for="">تلگرام</label>
                    </div>
                    <div class="box-body">
                        <input type="text" name="telegram" value="{{ $telegram }}" id="" class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <hr>
            <div class="col-md-6">
                <div class="box form-group">
                    <div class="box-header">
                        <label for="">دسته آموزش</label>
                    </div>
                    <div class="box-body">
                        <select name="learnCategory" id="" class="form-control">
                            <option value="0">انتخاب کنید ...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id==$learn?"selected":"" }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box form-group">
                    <div class="box-header">
                        <label for="">دسته مواد مصرفی</label>
                    </div>
                    <div class="box-body">
                        <select name="materialCategory" id="" class="form-control">
                            <option value="0">انتخاب کنید ...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id==$material?"selected":"" }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <button class="btn btn-success">بروزرسانی</button>
        </form>
    </section>
    <div class="clearfix"></div>
@endsection