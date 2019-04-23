@extends('admin.layouts.master')
@section('content')
<section class="content">

  <h3>مدیریت اسلایدشو</h3>
  <div class="box">
    <div class="box-heading">
      
    </div>
    <div class="box-body">
      <table class="table table-striped table-hover table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>عنوان</th>
            <th>تعداد اسلایدشو</th>
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
                <td>{{ $list->slideshows->count() }}</td>
                <td><a class="btn btn-primary btn-sm" href="{{ route('admin.slideshowManagement',[$list->id]) }}">مشاهده اسلایدشو</a></td>
            </tr>     
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="clearfix"></div>
</section>
@endsection