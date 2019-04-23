@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>ایجاد فایل برای زیردسته {!! $subCategory->name !!}</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{ route('admin.subCategory.storeFiles',[$subCategory->id]) }}" method="post">
            @csrf
            <div class="form-group col-md-6 col-xs-12">
                <label for="">نام فایل رو سفارش</label>
                <input type="text" name="front_file_label" id="" class="form-control">
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="">نام فایل پشت سفارش</label>
                <input type="text" name="back_file_label" id="" class="form-control"/>
            </div>
            <div class="col-md-12">
                <button class="btn btn-success">ثبت نهایی</button>
            </div>
        </form>
    </section>
@endsection