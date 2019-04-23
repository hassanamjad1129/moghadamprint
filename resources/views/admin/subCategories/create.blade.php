@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>ایجاد زیردسته جدید</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{ route('subCategories.store') }}" method="post">
            @csrf
            <div class="form-group col-md-6 col-xs-12">
                <label for="category_id">دسته پدر :</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="0">لطفا انتخاب کنید...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="name">نام زیر دسته</label>
                <input type="text" name="name" id="name" class="form-control"/>
            </div>
            <div class="form-group col-md-12">
                <label for="circulation">تیراژ</label>
                <input type="text" name="circulation" id="circulation" class="form-control"/>
            </div>
            
            <div class="col-md-12">
                <label for="">آپلود تصویر</label>
                <div class="input-group">
                           <span class="input-group-btn">
                             <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                               <i class="fa fa-picture-o"></i> انتخاب تصویر
                             </a>
                           </span>
                    <input id="thumbnail" class="form-control" type="text" name="picture">
                </div>
            </div>
            
            <div class="col-xs-12">
                <button class="btn btn-primary" type="submit" style="margin-top: 5px"><i class="fa fa-save"></i> ذخیره</button>
            </div>
        </form>
    </section>
@endsection
@section('extraScripts')
    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
@endsection