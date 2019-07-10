@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <h3>ویرایش اسلایدشو</h3>
        <form action="{{ route('admin.slideshow.edit',[$slideshow]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="col-md-4">
                <label for="">آپلود تصویر</label>
                <img src="{{ asset($slideshow->picture) }}" style="width:100%" alt="">
                <input type="file" name="picture" id="" class="form-control"/>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4">
                <label for="">لینک اسلایدشو(غیر الزامی)</label>
                <input type="text" name="link" id="" class="form-control"/>
            </div>
            <div class="clearfix"></div>

            <button class="btn btn-success" style="margin-top:5px">بروزرسانی</button>
        </form>
    </section>
@endsection