@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3>مدیریت سودها <a href="{{ route('benefits.create') }}" class="btn btn-primary pull-left">ایجاد آیتم
                        جدید</a></h3>
            </div>
            <div class="box-body">
                <table class="table table-border table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>حداقل</th>
                        <th>حداکثر</th>
                        <th>درصد</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    @foreach($benefits as $benefit)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ number_format($benefit->min) }} ریال</td>
                            <td>{{ $benefit->max?number_format($benefit->max)." ریال":"نامحدود" }}</td>
                            <td>{{ $benefit->percentage }} درصد</td>
                            <td>
                                <a href="{{ route('benefits.edit',[$benefit->id]) }}" class="btn btn-sm btn-warning">ویرایش</a>
                                <form action="{{ route('benefits.destroy',[$benefit->id]) }}" method="post"
                                      style="display: inline;">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-danger">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection