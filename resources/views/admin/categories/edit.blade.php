@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>ویرایش دسته بندی {{ $category->name }}</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{ route('categories.update',[$category->id]) }}" method="post">
            {{ method_field('patch') }}
            @csrf
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <p>مشخصات دسته بندی</p>
                    </div>
                    <div class="panel-body">
                        <label for="name" class="control-label">عنوان دسته بندی</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}"/>

                        <label for="name" class="control-label">توضیحات دسته بندی</label>
                        <textarea id="content" name="description"
                                  class="form-control">{{ $category->description }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <p>تصویر دسته بندی (غیر الزامی)</p>
                    </div>
                    <div class="panel-body">
                        <label for="">آپلود تصویر</label>
                        <div class="input-group">
                           <span class="input-group-btn">
                             <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                               <i class="fa fa-picture-o"></i> انتخاب تصویر
                             </a>
                           </span>
                            <input id="thumbnail" class="form-control" type="text" value="{{ $category->picture }}" name="filepath">
                        </div>
                        <img id="holder" src="{{ asset($category->picture) }}" class="img-responsive" style="margin-top:15px;max-height:100px;">
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <p>عملیات</p>
                    </div>
                    <div class="panel-body">
                        <button class="btn btn-success">بروزرسانی دسته بندی</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
    </section>
@endsection
@section('extraScripts')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
            language: 'fa'
        };
        CKEDITOR.replace('content', options);
        $('#lfm').filemanager('image');
    </script>

@endsection