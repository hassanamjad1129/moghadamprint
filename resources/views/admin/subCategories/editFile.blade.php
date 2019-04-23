@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>ویرایش فایل زیر دسته {{ $subCategory->name }}</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{ route('admin.subCategory.updateFiles',[$subCategory->id,$file->id]) }}" method="post">
            @csrf
            <div class="form-group col-md-6 col-xs-12">
                <label for="">نام فایل رو سفارش</label>
                <input type="text" name="front_file_label" id="" value="{{ $file->front_file_label }}"
                       class="form-control">
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="">نام فایل پشت سفارش</label>
                <input type="text" name="back_file_label" id="" value="{{ $file->back_file_label }}" class="form-control"/>
            </div>
            <div class="col-md-12">
                <button class="btn btn-success">بروزرسانی</button>
            </div>
        </form>
    </section>
@endsection