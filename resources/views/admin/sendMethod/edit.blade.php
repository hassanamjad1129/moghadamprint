@extends('admin.layouts.master')
@section('content')
<section class="content">
        <div class="box">
            <div class="box-header">
                <h2>بروزرسانی روش باربری</h2>
            </div><!-- /.box-header -->
            <div class="box-body">
              <form action="{{route('admin.sendMethod.update',[$sendMethod])}}" method="post">
                @csrf
                @method('patch');
        <div class="col-md-12">
          <input required type="text" name="sendMethod" placeholder="روش باربری" class="form-control" value="{{$sendMethod->name}}">  
        </div>
        <div>
          <button class="btn btn-success">
            ثبت
          </button>  
            </div>  
              </form>
        </div>
     </div>
  </section>
@endsection