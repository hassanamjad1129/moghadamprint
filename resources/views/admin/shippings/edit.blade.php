@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>ویرایش روش ارسال</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{ route('shippings.update',[$shipping->id]) }}" method="post">
            @csrf
            @method('patch')
            <div class="col-md-6">
                <label for="name">عنوان روش</label>
                <input type="text" value="{{ $shipping->name }}" name="name" id="name" class="form-control"/>
            </div>
            <div class="col-md-6">
                <label for="name">آیکن</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> انتخاب تصویر
                        </a>
                    </span>
                    <input id="thumbnail" class="form-control" type="text" value="{{ $shipping->icon }}" name="filepath">
                </div>
            </div>
            <div class="col-md-12">
                <label for="description">توضیحات</label>
                <input type="text" name="description" id="description" value="{{ $shipping->description }}"
                       class="form-control"/>
            </div>
            <div class="col-md-12">
                <button class="btn btn-success" style="margin-top: 5px">بروزرسانی روش</button>
            </div>
        </form>
    </section>
@endsection