@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>ارسال پیامک گروهی</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h4>ارسال پیامک گروهی</h4>
            </div>
            <div class="box-body">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-xs-12">
                        <label for="">متن پیامک</label>
                        <textarea name="description" class="form-control" id="" cols="30" rows="4"></textarea>
                        <button class="btn btn-success">ارسال</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection