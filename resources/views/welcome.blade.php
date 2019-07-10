@extends('layouts.app')
@section('extraContent')
    <style>
        @media screen and (max-width: 800px) {
            #welcomeModal .modal-dialog {
                width: 85% !important;
            }

            #welcomeModal .modal-body p {
                font-size: 13px
            }
        }

        @media screen and (max-width: 750px) {
            #welcomeModal .modal-dialog {
                width: 70% !important;
            }

            #welcomeModal .modal-body p {
                font-size: 13px
            }
        }
    </style>

@endsection
@section('content')
    <div id="mySlider" class="container">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($slideshows as $slideshow)
                    <div class="swiper-slide">
                        <a href="{{ $slideshow->link }}">
                            <img src="{{ asset($slideshow->picture) }}" alt="">
                        </a>
                        <div class="sliderHalf">
                            <div class="ribbon-3  animated fadeInRightBig">
                                <div class="ribbon3Inner">
                                    <p>مجتمع تبلیغاتی مقدم</p>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    <div class="container" style="padding: 0; ">
        <div class="container" style="padding: 0; ">
            <div id="mainContentTitle" style=" background: url(/assets/img/loginBack.png) repeat;">
                <div class="ribbon-4">
                    <div class="ribbon-content">
                        <p class="ribbonTitleInner">
                            خدمات مجتمع تبلیغاتی مقدم

                        </p>
                    </div>
                </div>
                <div class="deviderLine animated zoomIn"></div>
            </div>


        </div>
        <div id="mainContent" style="background: url(/assets/img/loginBack.png) repeat;">
            <div class="mainContentItem" onmouseenter="handleMainContentSubCats(this)"
                 onmouseleave="handleMainContentSubCats2(this)">
                <div class="dashedBorderMainItem tile js-tilt" data-tilt>
                    <div class="mainContentItemIconDiv">
                        <a class="mainContentItemIconLink" title="چاپ افست مقدم">
                            <img src="/assets/img/offsetIcon.jpg" class="" alt="چاپ افست مقدم">
                        </a>
                    </div>
                </div>

                <div class="mosallaOnDetail animated fadeIn"></div>

                <div class="mainContentItemDetails animated fadeIn" height="">
                    <div class="container">
                        <div class="container mainContentItemDetailsInner">
                            <a href="{{ route('customer.priceList',['تراکت']) }}" title="تراکت"
                               class="mainContentItemDetail">
                                <span>تراکت</span>
                            </a>
                            <a href="{{ route('customer.priceList',['کارت ویزیت']) }}" title="کارت ویزیت"
                               class="mainContentItemDetail">
                                <span>کارت ویزیت</span>
                            </a>

                            <a href="{{ route('customer.priceList',['سربرگ']) }}" title="سربرگ"
                               class="mainContentItemDetail">
                                <span>سربرگ</span>
                            </a>
                            <a href="{{ route('customer.priceList',['کاتالوگ']) }}" title="کاتالوگ"
                               class="mainContentItemDetail">
                                <span>کاتالوگ</span>
                            </a>
                            <a href="{{ route('customer.priceList',['پوستر']) }}" title="پوستر"
                               class="mainContentItemDetail">
                                <span>پوستر</span>
                            </a>
                            <a href="{{ route('customer.priceList',['فرم های قالب دار']) }}" title="فرم های قالب دار"
                               class="mainContentItemDetail">
                                <span>فرم های قالب دار</span>
                            </a>
                            <a href="{{ route('customer.priceList',['پاکت نامه']) }}" title="پاکت نامه"
                               class="mainContentItemDetail">
                                <span>پاکت نامه</span>
                            </a>
                            <a href="{{ route('customer.priceList',['جنیوس']) }}" title="جنیوس"
                               class="mainContentItemDetail">
                                <span>جنیوس</span>
                            </a>
                            <a href="{{ route('customer.priceList',['ریسو']) }}" class="mainContentItemDetail">
                                <span>ریسو</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mainContentItem" onmouseenter="handleMainContentSubCats(this)"
                 onmouseleave="handleMainContentSubCats2(this)">
                <a href="">
                    <div class="dashedBorderMainItem tile js-tilt" data-tilt>
                        <div class="mainContentItemIconDiv">
                            <a href="{{ route('customer.priceList',['تابلو تبلیغاتی']) }}" style="cursor : pointer"
                               class="mainContentItemIconLink">
                                <img src="/assets/img/ledIcon.jpg" class="" alt="تابلو تبلیغاتی مقدم">
                            </a>
                        </div>
                    </div>
                </a>
                <div class="mosallaOnDetail animated fadeIn"></div>
            </div>
            <div class="mainContentItem" onmouseenter="handleMainContentSubCats(this)"
                 onmouseleave="handleMainContentSubCats2(this)">
                <div class="dashedBorderMainItem tile js-tilt" data-tilt>
                    <div class="mainContentItemIconDiv">
                        <a href="{{ route('customer.priceList',['هدایای تبلیغاتی']) }}" style="cursor : pointer"
                           class="mainContentItemIconLink">
                            <img src="/assets/img/giftAdv.jpg" class="" alt="هدایای تبلیغاتی مقدم">
                        </a>
                    </div>
                </div>

                <div class="mosallaOnDetail animated fadeIn"></div>

            </div>
            <div class="mainContentItem" onmouseenter="handleMainContentSubCats(this)"
                 onmouseleave="handleMainContentSubCats2(this)">
                <div class="dashedBorderMainItem tile js-tilt" data-tilt>
                    <div class="mainContentItemIconDiv">
                        <a href="{{ route('customer.priceList',['دیجیتال مارکتینگ']) }}" style="cursor : pointer"
                           class="mainContentItemIconLink">
                            <img src="/assets/img/digitalMarketingIcon.jpg" class="" alt="دیجیتال مارکتینگ مقدم">
                        </a>
                    </div>
                </div>

                <div class="mosallaOnDetail animated fadeIn"></div>

            </div>

            <div class="mainContentItem" onmouseenter="handleMainContentSubCats(this)"
                 onmouseleave="handleMainContentSubCats2(this)">
                <div class="dashedBorderMainItem tile js-tilt" data-tilt>
                    <div class="mainContentItemIconDiv">
                        <a href="{{ route('customer.priceList',['ماشین آلات چاپ']) }}" style="cursor : pointer"
                           class="mainContentItemIconLink">
                            <img src="/assets/img/printers.jpg" class="" alt="ماشین آلات چاپ مقدم">
                        </a>
                    </div>
                </div>

                <div class="mosallaOnDetail animated fadeIn"></div>

            </div>
        </div>

    </div>

@endsection