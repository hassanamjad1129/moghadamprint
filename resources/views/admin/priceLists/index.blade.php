@extends('admin.layouts.master')
@section('content')
<section class="content">

  <h3>مدیریت لیست قیمت</h3>
  <div class="box">
    <div class="box-heading">
      
    </div>
    <div class="box-body">
      <table class="table table-striped table-hover table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>عنوان</th>
            <th>آخرین بروزرسانی</th>
            <th>عملیات</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1; ?>
          @foreach($lists as $list)
            @if($list->hasChild())
              <?php continue; ?>
            @endif
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $list->name.($list->parent_id?" (".$list->parentObject->name.") ":"") }}</td>
                <td>{{ $list->fileObject->updated_at?jdate(strtotime($list->fileObject->updated_at))->format('H:m:i | Y/m/d '):"تاکنون قیمتی وارد نشده است" }}</td>
                <td><button class="btn btn-primary btn-sm" onclick="updateCategory(this)" data-toggle="modal" data-target="#priceModal" category_id="{{ $list->id }}">بروزرسانی لیست قیمت</a></td>
            </tr>     
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="clearfix"></div>
</section>
<div id="priceModal" class="modal fade" role="dialog">
  <form action="" method="post" enctype="multipart/form-data">
      @csrf
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">آپلود فایل لیست قیمت جدید</h4>
          </div>
          <div class="modal-body">
            <label>فرمت مجاز جهت آپلود .xls می باشد</label>
            <input type="file" accept=".xls" name="file" class="form-control">
            <input type="hidden" name="category_id" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">انصراف</button>
            <button class="btn btn-success">بروزرسانی</button>
          </div>
        </div>

      </div>
  </form>
</div>
  @endsection
@section('extraScripts')
    <script src="/adminAsset/datatables/jquery.dataTables.min.js"></script>
    <script src="/adminAsset/datatables/dataTables.bootstrap.min.js"></script>

    <script>
        $("table").dataTable({
            "ordering": false
        });
        function updateCategory(elem){
            $("input[name=category_id]").val(elem.getAttribute('category_id'));
        }
    </script>
@endsection