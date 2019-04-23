@extends('admin.layouts.master') @section('content')
<section class="content">
  <div class="box">
    <div class="box-header">
      <h2>ایجاد خدمت جدید</h2>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form action="" method="post">
        @csrf
        <div class="col-md-6">
          <label for="">عنوان خدمت</label>
          <input type="text" name="name" class="form-control">
        </div>
        <div class="col-md-6">
          <label for="">به ازای هر :</label>
          <input type="number" min="1" name="capacity" id="" class="form-control">
        </div>
        <div class="col-md-6">
          <label for="">قیمت یک عدد <span class="badge badge-success">ریال</span></label>
          <input type="text" name="single_price" id="" class="form-control">
        </div>
        <div class="col-md-6">
          <label for="">قیمت دو عدد <span class="badge badge-success">ریال</span></label>
          <input type="text" name="double_price" id="" class="form-control">
        </div>
        <div class="col-md-12">
          <button class="btn btn-success">ثبت نهایی</button>
        </div>
      </form>

    </div>
  </div>
</section>
@endsection