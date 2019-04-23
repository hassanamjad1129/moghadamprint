@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>ایجاد فایل جدید</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{ route('downloads.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-9">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>مشخصات اصلی فایل</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="">عنوان فایل</label>
                            <input type="text" name="title" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">توضیحات</label>
                            <textarea type="text" name="description" id="" class="form-control"></textarea>
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
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="">آپلود تصویر آیکن</label>
                        <input type="file" name="icon" id="" class="form-control"/>

                        <label for="">آپلود فایل</label>
                        <input type="file" name="file" id="" class="form-control"/>

                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <button class="btn btn-success">ثبت نهایی</button>
            </div>
        </form>
    </section>

@endsection