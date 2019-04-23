@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>ایجاد فایل جدید</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{ route('downloads.update',[$download->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="col-md-9">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>مشخصات اصلی فایل</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="">عنوان فایل</label>
                            <input type="text" name="title" id="" value="{{ $download->title }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">توضیحات</label>
                            <textarea type="text" name="description" id="" rows="10"
                                      class="form-control">{{ $download->description }}</textarea>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>مشخصات فایل</h4>
                    </div>
                    <div class="panel-body">
                        <label for="">دسته بندی فایل</label>
                        <select name="category" id="" class="form-control">
                            <option value="0">انتخاب کنید ...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id==$download->category_id?"selected":"" }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="">آپلود تصویر آیکن</label>
                        <img src="{{ asset($download->icon) }}" alt="" class="img-responsive">
                        <input type="file" name="icon" id="" class="form-control"/>
                        <br>
                        <label for="">آپلود فایل</label>
                        <a href="{{ route('admin.downloads.file',[$download->id]) }}" class="btn btn-block btn-primary"><i class="fa fa-download"></i> دانلود فایل</a>

                        <input type="file" name="file" id="" class="form-control"/>

                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <button class="btn btn-success">بروزرسانی</button>
            </div>
        </form>
    </section>

@endsection