@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <h3>ایجاد حساب نمایندگی</h3>
        <div class="box">
            <div class="box-header">

            </div>
            <div class="box-body">
                <form action="{{ route('admin.customers.storeRepresentation',[$customer->id]) }}" method="post">
                    @csrf
                    <label for="">میزان درصد نمایندگی</label>
                    <input type="text" name="percentage" class="form-control">
                    <button class="btn btn-success" style="margin-top: 10px">ثبت نهایی</button>
                </form>
            </div>
        </div>
    </section>

@endsection