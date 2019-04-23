@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <div class="col-md-12">
            <div class="box">
                <div class="box-heading">
                    <h4>ویرایش دسته بندی</h4>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.galleryCategory.update',[$category]) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">نام دسته بندی</label>
                            <input type="text" name="name" value="{{ $category->name }}" class="form-control"/>
                        </div>
                        <button class="btn btn-success">ثبت نهایی</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

