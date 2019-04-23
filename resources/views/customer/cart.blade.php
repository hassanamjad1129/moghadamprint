@extends('customer.layouts.master')
@section('content')
    <style>
        .table tr {
            transition: all 0.4s ease;
        }

        .table th {
            color: #fff;
            font-family: Yekan;
            font-weight: normal;
            background-color: #66BB6A !important;
            text-align: center;
        }

        .table td {
            font-family: yekan;
            direction: rtl;
            text-align: center;
            vertical-align: middle;
        }

        #step-2 table label, #step-3 table label {
            position: relative;
            cursor: pointer;
            color: #666;
            font-size: 30px;
            margin: 0;
        }

        #step-2 table input[type="checkbox"], #step-2 table input[type="radio"], #step-3 table input[type="checkbox"], #step-3 table input[type="radio"] {
            position: absolute;
            display: none;
        }

        /*Check box*/
        input[type="checkbox"] + .label-text:before {
            content: "\f096";
            font-family: "FontAwesome";
            speak: none;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            width: 1em;
            display: inline-block;
            margin-right: 5px;
        }

        input[type="checkbox"]:checked + .label-text:before {
            content: "\f14a";
            color: #2980b9;
            animation: effect 250ms ease-in;
        }

        input[type="checkbox"]:disabled + .label-text {
            color: #aaa;
        }

        input[type="checkbox"]:disabled + .label-text:before {
            content: "\f0c8";
            color: #ccc;
        }

        /*Radio box*/

        input[type="radio"] + .label-text:before {
            content: "\f10c";
            font-family: "FontAwesome";
            speak: none;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            width: 1em;
            display: inline-block;
            margin-right: 5px;
        }

        input[type="radio"]:checked + .label-text:before {
            content: "\f192";
            color: #8e44ad;
            animation: effect 250ms ease-in;
        }

        input[type="radio"]:disabled + .label-text {
            color: #aaa;
        }

        input[type="radio"]:disabled + .label-text:before {
            content: "\f111";
            color: #ccc;
        }

        /*Radio Toggle*/

        .toggle input[type="radio"] + .label-text:before {
            content: "\f204";
            font-family: "FontAwesome";
            speak: none;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            width: 1em;
            display: inline-block;
            margin-right: 10px;
        }

        .toggle input[type="radio"]:checked + .label-text:before {
            content: "\f205";
            color: #66BB6A;
            animation: effect 250ms ease-in;
        }

        .toggle input[type="radio"]:disabled + .label-text {
            color: #aaa;
        }

        .toggle input[type="radio"]:disabled + .label-text:before {
            content: "\f204";
            color: #ccc;
        }

        @keyframes effect {
            0% {
                transform: scale(0);
            }
            25% {
                transform: scale(1.3);
            }
            75% {
                transform: scale(1.4);
            }
            100% {
                transform: scale(1);
            }
        }

        .sw-container {
            width: 100%;
        }

        .wizardImageItem p {
            text-align: center;
            font-family: Yekan;
            font-weight: bold;
            line-height: 2em;
        }

        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .upload-btn-wrapper .btn {
            border: 2px solid gray;
            color: gray;
            background-color: white;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 20px;
            font-weight: bold;
            transition: all .2s ease;
        }

        .upload-btn-wrapper:hover .btn {
            border: 2px solid gray;
            color: white;
            background-color: gray;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 20px;
            font-weight: bold;
        }

        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
        }

        .step2Content {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .col-md-6 {
            float: right;
            text-align: right;
        }

        .table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
            border: 2px solid #66bb6a;
            vertical-align: middle;
        }

        #finishProccessBtn {

        }

        #finishProccessBtn button {
            border: none;
            transition: all ease-in .15s;
            padding: 1.2rem 2rem 1.2rem 2rem;
            background-color: #918e88;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            border-radius: 2px;
        }

        #finishProccessBtn button i {
            color: #fff;
            font-size: 2.5rem;
            margin-left: 1rem;
        }

        #finishProccessBtn button span {
            color: #fff;
            font-size: 1.8rem;
            font-weight: bold;
            font-family: yekan;
        }

        #finishProccessBtn button:hover {
            background-color: #54b35c;
            text-decoration: none;
        }

        #finishProccessBtn a:hover i {

        }

        #finishProccessBtn a:hover span {

        }

        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #ddd;
        }


    </style>
    <h3 class="text-center">سبد خرید</h3>
    <form action="" method="post" style="padding: 15px">
        @csrf
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>انتخاب</th>
                <th>دسته بندی محصول</th>
                <th>نوع جنس</th>
                <th>ابعاد</th>
                <th>سرعت چاپ</th>
                <th>نوع کار</th>
                <th>تعداد لت</th>
                <th>سری</th>
                <th>قسمت رو کار</th>
                <th>قسمت پشت کار</th>  
                <th>قیمت واحد</th>
                <th>خدمات</th>
                <th>قیمت نهایی</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1 ?>
            @foreach($items->reverse() as $item)
                <?php
                $product = $item->product;
                ?>
                <tr>
                    <td><input type="checkbox" name="select[]" style="width: 24px;height: 24px;" value="{{ $item->id }}"
                               id=""></td>
                    <td>{{ $product->subcategory->category->name }}</td>
                    <td>{!! $product->subcategory->name !!}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $item->speed=="fast"?"فوری":"عادی" }}</td>
                    <td>{{ $item->type=="single"?"یک رو":"دو رو" }}</td>
                    <td>{{ $item->lats }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>
                        @foreach($item->files as $file)
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
                        @foreach($item->files as $file)
                      <?php
                      $imgAddress=explode('/',$file->back);
                      $imgAddress[count($imgAddress)-1]='test-'.$imgAddress[count($imgAddress)-1];
                      $back=implode('/',$imgAddress)
                      ?>
                      
                      <img src="{{ asset($back) }}" style="width:120px" alt="">
                            <br>
                        @endforeach
                    </td>
                    
                    <td>
                      @if($item->speed=="fast")
                        @if($item->type=="single")
                          <?php  $unitPrice=$product->fast_single_price; ?>
                          {{ number_format($product->fast_single_price) }} ریال
                        @else
                          <?php $unitPrice=$product->fast_double_price; ?>
                          {{ number_format($product->fast_double_price) }} ریال
                        @endif
                      @else
                        @if($item->type=="single")
                          <?php $unitPrice=$product->single_price; ?>
                          {{ number_format($product->single_price) }} ریال
                        @else
                          <?php $unitPrice=$product->double_price; ?>
                          {{ number_format($product->double_price) }} ریال
                        @endif
                      @endif
                      
                  
                  </td>
                    <td><?php
                        $price=0;
                        if($item->itemServices->count())
                          foreach($item->itemServices as $service){
                            $price+=$service->price*(($item->lats*$item->qty*$product->subcategory->circulation)/$service->service->capacity)*$item->lats*$item->qty;
                          }
                        echo number_format($price).' ریال';
                      ?></td>
                    <td>{{ number_format($unitPrice*$item->lats*$item->qty+$price) }} ریال</td>
                    <td>
                      <a href="{{ route('customer.removeCart',[$item->id]) }}">
                        <i class="ion-close-circled text-danger" style="font-size: 25px"></i>
                      </a>
                  </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
            <div id="finishProccessBtn" style="margin: 1rem">
                <button>
                    <i class="ion-bag"></i>
                    <span>تایید نهایی و پرداخت</span>
                </button>
            </div>
        </div>
    </form>
@endsection