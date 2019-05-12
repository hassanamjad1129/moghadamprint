@extends('customer.layouts.master') @section('extraStyle')
    <link rel="stylesheet" href="/adminAsset/datatables/jquery.dataTables.css">
    <link rel="stylesheet" href="/adminAsset/datatables/dataTables.bootstrap.css"> @endsection @section('content')
    <style>
        @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");

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

        #step-2 table label,
        #step-3 table label {
            position: relative;
            cursor: pointer;
            color: #666;
            font-size: 30px;
            margin: 0;
        }

        #step-2 table input[type="checkbox"],
        #step-2 table input[type="radio"],
        #step-3 table input[type="checkbox"],
        #step-3 table input[type="radio"] {
            position: absolute;
            display: none;
        }

        /*Check box*/

        input[type="checkbox"] + .label-text:before {
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

        input[type="checkbox"]:checked + .label-text:before {
            content: "\f192";
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

        /*



          */
        .toggle input[type="checkbox"] + .label-text:before {
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

        .toggle label {
            position: relative;
            cursor: pointer;
            color: #666;
            font-size: 31px;
            margin: 0;
        }

        .toggle input[type="checkbox"]:checked + .label-text:before {
            content: "\f205";
            color: #66BB6A;
            animation: effect 250ms ease-in;
        }

        .toggle input[type="checkbox"]:disabled + .label-text {
            color: #aaa;
        }

        .toggle input[type="checkbox"]:disabled + .label-text:before {
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

        /*



          */


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
            height: 100%;
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

        .table-bordered > tbody > tr > td,
        .table-bordered > tbody > tr > th,
        .table-bordered > tfoot > tr > td,
        .table-bordered > tfoot > tr > th,
        .table-bordered > thead > tr > td,
        .table-bordered > thead > tr > th {
            border: 2px solid #66bb6a;
            vertical-align: middle;
        }

        #finishProccessBtn {
        }

        #finishProccessBtn a {
            transition: all ease-in .15s;
            padding: 1.2rem 2rem 1.2rem 2rem;
            background-color: #43A047;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            border-radius: 2px;
        }

        #finishProccessBtn a i {
            color: #fff;
            font-size: 2.5rem;
            margin-left: 1rem;
        }

        #finishProccessBtn {
            background-color: #5cb85c;
            padding: 15px 29px;
            color: #FFF;
            cursor: pointer;
            font-size: 22px;
        }

        #finishProccessBtn a span {
            color: #fff;
            font-size: 1.8rem;
            font-weight: bold;
            font-family: yekan;
        }

        #finishProccessBtn a:hover {
            background-color: #1B5E20;
            text-decoration: none;
        }

        #finishProccessBtn a:hover i {
        }

        #finishProccessBtn a:hover span {
        }

        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #ddd;
        }

        .check {
            opacity: 0.5;
            color: #996;
        }

        .box {
            margin-bottom: 5px;
        }

        .input-hidden {
            display: none;
        }

        input[type=radio]:checked + label > img {
            border: 1px solid #fff;
            box-shadow: 0 0 3px 3px #090;
        }

        .speed input[type=radio]:checked + label > img {
            border: 1px solid #fff;
            box-shadow: 0 0 3px 3px #ff4444;
        }

        /* Stuff after this is only to make things more pretty */

        input[type=radio] + label > img {
            border: 1px solid #444;
            width: 150px;
            height: 80px;
            transition: 500ms all;
        }

        input[type=radio]:checked + label > img {
            transform: rotateZ(-10deg) rotateX(10deg);
        }

    </style>
    <form action="" method="post" id="finalStep" enctype="multipart/form-data">
        <?php
        if(1){
        ?>
        <div id="smartwizard">
            <ul>
                <li><a href="#step-1">۱<br/>
                        <small>دسته بندی</small>
                    </a></li>
                <li><a href="#step-2">۲<br/>
                        <small>نوع کار</small>
                    </a></li>
                <li><a href="#step-3">۳<br/>
                        <small>مشخصات سفارش</small>
                    </a></li>
                <li><a href="#step-4">۴<br/>
                        <small>آپلود فایل</small>
                    </a></li>
            </ul>

            <div>
                <div id="step-1" class="">
                    <div class="wizardMultiImageSection">
                        @foreach($categories as $category)
                            <div class="wizardImageItem" catId="{{ $category->id }}"
                                 onclick="categorySelectHandler(this)">
                                <img src="{{ asset($category->picture) }}" alt="{{ $category->name }}">
                                <p>{{ $category->name }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div id="step-2" class="">
                    <div class="step2Content">

                    </div>
                </div>
                <div id="step-3" class="">

                </div>
                <div id="step-4">
                    <div class="files"></div>
                    <label for="description" class="pull-right">توضیحات</label>
                    <textarea class="form-control" id="description" name="description" placeholder="توضیحات"></textarea>
                    <div style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                        <div id="finishProccessBtn" data-toggle="collapse" data-target="#services" style="margin: 1rem">
                            <i class="fa fa-cog"></i>
                            <span> مشاهده خدمات پس از چاپ</span>
                        </div>
                    </div>
                    <div id="services" class="collapse">
                        <h3 style="text-align:center">خدمات پس از چاپ</h3>

                        <table class="table table-striped table-bordered table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>انتخاب</th>
                                <th>عنوان خدمت</th>
                                <th>قیمت</th>
                                <th>(درصورتی که نیاز به توضیح خاصی هست اینجا وارد کنید)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td>
                                        <div class="form-check"><label class="toggle"><input type="checkbox"
                                                                                             style="display:none"
                                                                                             name="services[]"
                                                                                             value="5"><span
                                                        class="label-text" style="font-size:31px"></span></label></div>
                                    </td>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->single_price }} ریال</td>
                                    <td><textarea class="form-control" name="description-{{ $service->id }}" id=""
                                                  cols="30" rows="2"></textarea></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                        <div id="finishProccessBtn" style="margin: 1rem" onclick="finisheProccess()">
                            <i class="ion-checkmark"></i>
                            <span>ثبت سفارش</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }else{
        ?>
        <h2 style="text-align:center">با عرض پوزش تا اطلاع ثانوی قادر به سفارش گیری نخواهیم بود</h2>
        <?php } ?>
        <div class="modal fade" id="result" style="background:rgba(0,0,0,.6)">
            <div class="modal-dialog modal-lg" style="width: 95%">
                <div class="modal-content">
                    <div class="modal-heading">
                        <i class="ion-close-circled text-danger"
                           style="font-size: 45px;margin-right: 1rem;cursor: pointer" onclick="closeResultModal()"></i>
                        <p style="display: inline;font-size: 26px;">تشخیص خط برش</p>
                    </div>
                    <div class="modal-body" style="overflow: scroll;">

                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection @section('extraScripts')
    <script src="/assets/js/jquery.form.min.js"></script>
    <script>
        function closeMyModal() {
            var modalElem = document.getElementById("myModal1");
            modalElem.style.display = "none";
        }
    </script>
    <script src="/adminAsset/datatables/jquery.dataTables.min.js"></script>
    <script src="/adminAsset/datatables/dataTables.bootstrap.min.js"></script>

@endsection