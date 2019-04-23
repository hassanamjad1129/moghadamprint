@extends('admin.layouts.master') @section('content')
<section class="content">
  <div class="box">
    <div class="box-header">
      <h2>ویرایش خدمت</h2>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form action="" method="post">
        @csrf
        @method('patch')
        <div class="col-md-6">
          <label for="">عنوان خدمت</label>
          <input type="text" name="name" value="{{ $service->name }}" class="form-control">
        </div>
        <div class="col-md-6">
          <label for="">به ازای هر :</label>
          <input type="number" min="1" name="capacity" value="{{ $service->capacity }}" id="" class="form-control">
        </div>
        <div class="col-md-6">
          <label for="">قیمت یک عدد <span class="badge badge-success">ریال</span></label>
          <input type="text" name="single_price" id="" value="{{ $service->single_price }}" class="form-control">
        </div>
        <div class="col-md-6">
          <label for="">قیمت دو عدد <span class="badge badge-success">ریال</span></label>
          <input type="text" name="double_price" id="" value="{{ $service->double_price }}" class="form-control">
        </div>
        <div class="col-md-12">
          <button class="btn btn-success">بروزرسانی</button>
        </div>
      </form>

    </div>
  </div>
</section>
@endsection