@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>سفارشات مشتری {{ $customer->name }}</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="panel panel-body">
            <table class="table table-striped table-bordered table-hover datatable" id="dataTables-example">
                <thead>
                <tr>
                    <th>شماره سفارش</th>
                    <th>محصول</th>
                    <th>تیراژ</th>
                    <th>لت</th>
                    <th>فایل رو</th>
                    <th>فایل پشت</th>
                    <th>قیمت واحد</th>
                    <th>تخفیف</th>
                    <th>قیمت کل</th>
                    <th>وضعیت</th>
                    <th>تاریخ سفارش</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->product->subcategory->category->name.' '.$order->product->subcategory->name.' '.$order->product->name }}</td>
                        <td>{{ $order->qty }}</td>
                        <td>{{ $order->lats }}</td>
                        <td>
                        @foreach($order->files as $file)
                      <?php
                      $imgAddress=explode('/',$file->front);
                      $imgAddress[count($imgAddress)-1]='test-'.$imgAddress[count($imgAddress)-1];
                      $front=implode('/',$imgAddress)
                      ?>
                            <img src="{{ asset($front) }}" style="width: 120px" alt="">
                            <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($order->files as $file)
                      <?php
                      $imgAddress=explode('/',$file->back);
                      $imgAddress[count($imgAddress)-1]='test-'.$imgAddress[count($imgAddress)-1];
                      $back=implode('/',$imgAddress)
                      ?>
                      
                      <img src="{{ asset($back) }}" style="width:120px" alt="">
                            <br>
                        @endforeach
                    </td>
                    
                        <td>{{ number_format($order->unit_price) }} ریال</td>
                        <td>{{ number_format($order->discount*$order->qty) }} ریال</td>
                        <td>{{ number_format(($order->unit_price-$order->discount)*$order->qty*$order->lats) }} ریال</td>
                        <td>
                        <?php
                        if($order->verified==1){
                          switch ($order->status) {
                              case 0:
                                  echo "<span class='badge-danger'>در انتظار تایید</span>";
                                  break;
                              case 1:
                                  echo "<span class='badge'>تایید مالی</span>";
                                  break;
                              case 2:
                                  echo "<span class='badge'>چیدمان</span>";
                                  break;
                              case 3:
                                  echo "<span class='badge'>فرم بندی</span>";
                                  break;
                              case 4:
                                  echo "<span class='badge'>لیتوگرافی</span>";
                                  break;
                              case 5:
                                  echo "چاپ و روکش";
                                  break;
                              case 6:
                                  echo "برش و بسته بندی";
                                  break;
                            case 7 :
                              echo "آماده تحویل";
                              break;
                            case 8 :
                              echo "تحویل نهایی";
                              break;

                          }
                          }   
                       else{
                         echo "در انتظار پرداخت";
                       }   
                          ?>
                    </td>
                    
                        <td>{{ jdate(strtotime($order->created_at))->format('H:i | Y/m/d') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
@section('extraScripts')
    <script src="/adminAsset/datatables/jquery.dataTables.min.js"></script>
    <script src="/adminAsset/datatables/dataTables.bootstrap.min.js"></script>

    <script>
        $("table").dataTable({
            "order": [[ 0, "desc" ]]
        });
    </script>
@endsection