@extends('admin.layouts.master') @section('content')
<section class="content">
  <h3 class="text-center" style="margin-bottom: 20px">آرشیو سفارشات</h3>
  <div class="col-md-12 box" style="padding:5px">
    <form action="" method="post" enctype="multipart/form-data">
      @csrf @foreach($options as $option)
      <div class="col-md-6">
        <h4>{{ $option->label }}</h4>
        <input {{ $option->option_name=='priceList'?'type=file':'type=text' }} class="form-control" name="{{ $option->option_name }}" value="{{ $option->option_value }}">
      </div>
      @endforeach
      <div class="clearfix"></div>
      <div class="col-md-12">
        <button class="btn btn-sm btn-success">بروزرسانی</button>
      </div>
    </form>

  </div>
  <div class="clearfix"></div>

</section>
<div class="clearfix"></div>
@endsection