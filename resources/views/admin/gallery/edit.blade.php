@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>ویرایش گالری</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{ route('admin.gallery.update',[$gallery]) }}" method="post" enctype="multipart/form-data">
          @csrf
            <div class="col-md-9">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>مشخصات اصلی </h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="">دسته بندی</label>
                            <select name="category" id="" class="form-control">
                              <option value="">انتخاب کنید ...</option>
                              @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id==$gallery->category_id?"selected":"" }}>{{ $category->name }}</option>
                              @endforeach
                            </select>
                        </div>
                      
                        <div class="form-group">
                            <label for="">تصویر</label>
                            <img src="{{ asset($gallery->picture) }}" alt="">
                            <input type="file" name="picture" class="form-control" id="">
                        </div>
                      
                       <div class="form-group">
                            <label for="">متن اول</label>
                            <input type="text" name="title1" value="{{ $gallery->title1 }}" class="form-control" id="">
                        </div>
                      
                       <div class="form-group">
                            <label for="">متن دوم</label>
                            <input type="text" name="title2" value="{{ $gallery->title2 }}" class="form-control" id="">
                        </div>
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