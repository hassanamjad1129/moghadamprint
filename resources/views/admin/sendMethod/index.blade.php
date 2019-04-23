@extends('admin.layouts.master')
@section('extraStyle')
    <link rel="stylesheet" href="/adminAsset/datatables/dataTables.bootstrap.css">
@endsection
@section('content')
<section class="content">
        <div class="box">
            <div class="box-header">
                <h2>مدیریت باربری</h2>
              <span class="pull-left"><a href="{{route('admin.sendMethod.create')}}" class="btn btn-success">ثبت روش باربری جدید</a></span>
            </div><!-- /.box-header -->
            <div class="box-body">
        <div class="col-md-12">
            <table class="table table-bordered table-hover dataTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>عنوان روش باربری</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody id="sendMethod">
                      <?php $i=1; ?>
                      @foreach($sendMethods as $sendMethod)
                   <tr>
                     <td>{{$i++}}</td>
                     <td>{{$sendMethod->name}}</td>
                     <td><div class="btn-group">
                       <a href="{{route('admin.sendMethod.edit',[$sendMethod])}}" class="btn btn-warning">بروزرسانی</a>
                       <form action="{{route('admin.sendMethod.delete',[$sendMethod])}}" method="post" style="display: inline">
                         @csrf
                         @method('delete')
                         <button class="btn btn-danger"style="border-bottom-right-radius: 0;border-top-right-radius: 0;">حذف</button>
                       </form>
                       </div></td>
                      </tr>
                      @endforeach
              </tbody>         
         </table>
        </div>
              
        </div>
     </div>
  </section>
@endsection

@section('extraScripts')
    <script src="/adminAsset/datatables/jquery.dataTables.min.js"></script>
    <script src="/adminAsset/datatables/dataTables.bootstrap.min.js"></script>

    <script>
        $("table").dataTable();
    </script>
@endsection