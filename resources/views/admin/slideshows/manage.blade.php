@extends('admin.layouts.master')
@section('content')
<section class="content">

  <h3>مدیریت اسلایدشو</h3>
  <div class="box">
    <div class="box-heading">
      
    </div>
    <div class="box-body">
      <a href="{{ route('admin.slideshow.create',[$category]) }}" class="btn btn-primary">ایجاد تصویر</a>
      <table class="table table-striped table-hover table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>تصویر</th>
            <th>عملیات</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1; ?>
          @foreach($slideshows as $slideshow)
            <tr>
                <td>{{ $i++ }}</td>
                <td><img src="{{ asset($slideshow->picture) }}" style="width:150px" alt=""></td>
                <td>
                    <a class="btn btn-success btn-sm" href="{{ route('admin.slideshow.edit',[$slideshow->id]) }}">ویرایش</a>
                    <a class="btn btn-danger btn-sm" href="{{ route('admin.slideshow.remove',[$slideshow->id]) }}">حذف تصویر</a>
                </td>
            </tr>     
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="clearfix"></div>
</section>
@endsection