@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3>ویرایش آیتم سود</h3>
            </div>
            <div class="box-body">
                <form action="{{ route('benefits.update',[$benefit->id]) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="col-md-6">
                        <label for="">حداقل میزان خرید <span class="badge badge-info">ریال</span></label>
                        <input type="text" value="{{ number_format($benefit->min) }}" name="min"
                               class="form-control price">
                    </div>
                    <div class="col-md-6">
                        <label for="">حداکثر میزان خرید <span class="badge badge-info">ریال</span></label>
                        <input type="text" value="{{ number_format($benefit->max) }}" name="max"
                               class="form-control price">
                    </div>
                    <div class="col-md-12">
                        <label for="">درصد سود</label>
                        <input type="text" name="percentage" value="{{ number_format($benefit->percentage) }}"
                               class="form-control">
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-success" style="margin-top: 10px">بروزرسانی</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('extraScripts')
    <script>
        $('.price').keydown(function (event) {
            if (event.keyCode == 46 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 8 || (event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode >= 35 && event.keyCode <= 39)) {
                return;
            } else {
                if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
                    event.preventDefault();
                }
            }
        });
        $('.price').keyup(function (event) {
            var $this = $(this);
            var strInput = $this.val();
            strInput = strInput.replace(/ /g, '');
            strInput = strInput.replace(/,/g, '');
            $this.val(strInput.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });
    </script>
@endsection