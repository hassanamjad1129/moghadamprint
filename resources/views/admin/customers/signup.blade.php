@extends('admin.layouts.master') @section('content')
<style>
  td a,
  td button {
    margin: 5px 0;
  }
</style>
<section class="content-header">
  <h2>مشتریان</h2>
</section>
<!-- Main content -->
<section class="content">
  <div class="panel panel-body">
    <form action="" method="post">
      @csrf
      <div class="col-md-6">
        <label for="">نام و نام خانوادگی</label>
        <input type="text" name="name" id="" class="form-control">
      </div>
      <div class="col-md-6">
        <label for="">شماره تلفن همراه</label>
        <input type="text" name="phone" id="" class="form-control">
      </div>
      <div class="col-md-6">
        <label for="">جنسیت</label>
        <div class="clearfix"></div>
        <div class="col-md-2">
          <input type="radio" name="gender" value="male">
          <label for="">مرد</label>
        </div>
        <div class="col-md-2">
          <input type="radio" name="gender" value="female">
          <label for="">زن</label>
        </div>
      </div>
      <div class="col-md-6">
        <label for="">آدرس</label>
        <input type="text" name="address" class="form-control">
      </div>
      <div class="col-md-6">

        <button class="btn btn-success">ثبت</button>
      </div>
    </form>

  </div>
</section>
@endsection