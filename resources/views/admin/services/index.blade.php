@extends('admin.layouts.master') @section('content')
<section class="content-header">
  <h2>خدمات پس از چاپ</h2>
</section>
<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header"></div>
    <div class="box-body">
      <a href="{{ route('admin.services.create') }}" class="btn btn-primary">افزودن خدمت جدید</a>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th>ردیف</th>
            <th>نام خدمت</th>
            <th>قیمت به ازای هر </th>
            <th>قیمت یک عدد</th>
            <th>قیمت دو عدد</th>
            <th>عملیات</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1; ?> @foreach($services as $service)
          <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $service->name }}</td>
            <td>{{ $service->capacity }} عدد</td>
            <td>{{ number_format($service->single_price) }} ریال</td>
            <td>{{ number_format($service->double_price) }} ریال</td>
            <td><a href="{{ route('admin.services.edit',[$service->id]) }}" class="btn btn-success">ویرایش</a>
              <form action="{{ route('admin.services.destroy',[$service->id]) }}" method="post" style="display:inline">
                @csrf
                @method('delete')
                <button class="btn btn-danger">حذف</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>
@endsection @section('extraScripts')
<script src="/adminAsset/datatables/jquery.dataTables.min.js"></script>
<script src="/adminAsset/datatables/dataTables.bootstrap.min.js"></script>

<script>
  $("table").dataTable();
</script>
@endsection