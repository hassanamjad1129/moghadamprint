@extends('admin.layouts.master')
@section('content')
<section class="content">
        <div class="box">
            <div class="box-header">
                <h2>ثبت روش باربری جدید</h2>
            </div><!-- /.box-header -->
            <div class="box-body">
              <form action="{{route('admin.sendMethod.store')}}" method="post">
                @csrf
        <div class="col-md-12">
          <input required type="text" name="sendMethod" placeholder="روش باربری" class="form-control">  
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