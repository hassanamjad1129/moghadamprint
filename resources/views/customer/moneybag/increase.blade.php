@extends('customer.layouts.master')
@section('content')

    <div class="col-md-12" style="padding: 20px">
        <h4>افزایش اعتبار کیف پول</h4>
        <form action="" method="post" style="margin-top: 10px">
            @csrf
            <label for="">مبلغ</label>
            <div class="input-group">
                <input id="amount" type="text" class="form-control" name="amount"
                       placeholder="مبلغ مورد نظر خود را وارد کنید">
                <span class="input-group-addon">ریال</span>
            </div>
            <button class="btn btn-success" style="margin-top: 10px">
                ایجاد درخواست
            </button>
        </form>
    </div>
@endsection