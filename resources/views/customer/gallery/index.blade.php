@extends('customer.layouts.master')
@section('content')

    <link rel="stylesheet" type="text/css" href='/assets/css/carouFredSel.css'/>
    <link rel="stylesheet" type="text/css" href='/assets/css/prettyPhoto.css'/>
    <style>
        /* PORTFOLIO */

        .filters-button-group {
            text-align: right;
            display: block;
            margin-bottom: 50px;
            display: flex;
            justify-content: center;
        }

        .filters-button-group .button {
            display: inline-block;
            transition: color .2s linear;
        }

        .filters-button-group .button.is-checked {
            color: #FD3137;
        }

        .filters-button-group .button:hover {
            color: #FD3137;
            cursor: pointer;
        }

        .filters-button-group .button:after {
            content: "\2022";
            display: inline-block;
            margin: 0 20px;
            color: #e2dfd9;
        }

        .filters-button-group .button:last-child:after {
            content: '';
            display: none;
        }

        .grid {
            width: 100%;
            margin: 0 auto;
            overflow: hidden;
            position: relative;
            display: block;
        }

        .grid-item {
            float: right;
            font-size: 0;
            line-height: 0;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            position: relative !important;
            top: auto !important;
            left: auto !important
        }

        #content .grid-item img {
            display: block;
            width: 100%;
            height: auto;
            max-height: none;
            max-width: none;
        }


        .grid-item.p_two_third {
            width: 886px;
        }

        .grid-item.p_one {
            width: 1329px;
        }

        .portfolio-text-holder {
            position: absolute;
            top: 30px;
            left: 30px;
            bottom: 30px;
            right: 30px;
            z-index: 1;
            font-size: 20px;
            background-color: white;
            text-align: center;
            display: none;
        }

        .portfolio-text-holder p {
            margin-top: 60px !important
        }

        .portfolio-text-holder p:nth-child(2) {
            color: #777
        }

        .grid-item a:hover {
            color: #191919;
        }

        div.pp_default .pp_loaderIcon {
            display: none !important;
        }
    </style>
    <div class="body-wrapper">
        <div id="content" class="site-content">
            <article>
                @foreach($categories as $category)
                    <div class="col-md-3">
                        <a href="#" style="padding: 2rem;text-align: center;width: 100%">{{ $category->name }}</a>
                    </div>
                @endforeach

            </article>
        </div>
    </div>
@endsection
