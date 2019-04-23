@extends('admin.layouts.master')
@section('content')
<section class="content">
    <h3>افزودن تصویر به اسلایدشو</h3>
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
      <label for="">آپلود تصویر</label>
      <input type="file" name="picture" id="" class="form-control" />
      <button class="btn btn-success" style="margin-top:5px">ثبت نهایی</button>
    </form>
</section>
@endsection