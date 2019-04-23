@extends('admin.layouts.master')
@section('extraStyle')
    <link rel="stylesheet" href="/adminAsset/datatables/dataTables.bootstrap.css">
@endsection
@section('content')
<section class="content">
        <div class="box">
               <div class="box-header">
                <h2>مدیریت ارسال به شهرستان</h2>
               </div><!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
                @if($type == 'record')
                <a href="{{route('admin.deliverie.index')}}" class="btn btn-info">
                  صفحه اصلی
                </a>
                @elseif($type == 'index')
                <a href="{{route('admin.deliverie.index',['record'])}}" class="btn btn-warning">
                  بایگانی
                </a>
                @endif
               <br>
        </div>
            <table class="table table-bordered table-hover dataTable">
                    <thead>
                    <tr>
                        <th>#</th>
                      <th>نام</th>
                        <th>توضیحات</th>
                      <th>تاریخ ثبت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody id="deliverie">
                      <?php $i=1; ?>
                   @foreach($deliveries as $deliverie)
                      <tr>
                        <td>{{$i++}}</td>
                        <td>{{$deliverie->user->name}}</td>
                        <td>{{$deliverie->description}}</td>
                        <td>{{ jdate(strtotime($deliverie->created_at))->format('H:i | Y/m/d') }}</td>
                        <td>
                            <div class="btn-group">
                              <a href="{{route('admin.deliverie.detail',[$deliverie])}}" class="btn btn-info">مشاهده جزئیات</a>
                          </div>
                        </td>
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