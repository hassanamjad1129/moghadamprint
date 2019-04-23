@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>نمایش اطلاعات دسته بندی {{ $category->name }}</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3>اطلاعات دسته {{ $category->name }}</h3>
            </div>
            <div class="box-body">
                <div class="col-md-8">
                    <h4>توضیحات</h4>
                    {!! $category->description !!}
                </div>
                <div class="col-md-4">
                    <h4>تصویر دسته بندی</h4>
                    <img src="{{ asset($category->picture) }}" class="img-responsive"/>
                </div>
                <a href="{{ route('categories.index') }}" class="btn btn-primary">بازگشت</a>
                <a href="{{ route('categories.edit',[$category->id]) }}" class="btn btn-warning">ویرایش دسته بندی</a>
            </div>
        </div>
    </section>

@endsection