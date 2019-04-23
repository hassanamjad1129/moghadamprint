@extends('customer.layouts.master')
@section('content')
    <div class="col-md-12">
        <h4>سوابق شارژ </h4>
        <table class="table table-hover table-striped table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>مبلغ</th>
                <th>عملیات</th>
                <th>نوع</th>
                <th>تاریخ</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1 ?>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ number_format($log->price) }} ریال</td>
                    <td>{{ $log->operation=="increase"?"افزایش":"کاهش" }}</td>
                    <td>{{ $log->type=="payment"?"پرداخت از طریق درگاه":$log->description }}</td>

                     <td>{{ jdate(strtotime($log->created_at))->format('H:i | Y/m/d') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('extraScripts')
    <script src="/adminAsset/datatables/jquery.dataTables.min.js"></script>
    <script src="/adminAsset/datatables/dataTables.bootstrap.min.js"></script>

    <script>
        $("table").dataTable();
    </script>
@endsection