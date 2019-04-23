<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>مدیریت حساب کاربری</title>
    <link rel="stylesheet" href="/assets/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/css/swiper.css">

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link rel="stylesheet" href="/assets/css/smart_wizard.min.css">
    <link rel="stylesheet" href="/assets/css/smart_wizard_theme_circles.min.css">
    <link rel="stylesheet" href="/assets/css/userPanel.css">
    <link rel="stylesheet" href="/assets/css/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/animate.min.css">
    <link rel="stylesheet" href="/assets/css/alertify.css">
    <link rel="stylesheet" href="/assets/css/swiper.min.css">
    <style>
      html, body {
      position: relative;
      height: 100%;
    }
      .swiper-container {
      width: 100%;
      height: 100%;
    }
    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }
  </style>
    <!--===============================================================================================-->
</head>
<body>

<div class="main">

    <div id="mainMenu" style="display: flex; float: right;" class="col-md-2">
        <div id="rightSide" style = "overflow-y :scroll;">
            <div class="logoSection">
                <img src="/assets/img/moqaddamLogo.png" alt="">
            </div>
            @include('customer.layouts.sidebar')
        </div>
    </div>
    <div id="mainContent">
        <div id="leftSide" style="width: 80%">

            <!--header start-->
            <div id="header">
                <div id="headerRightSide">
                    <a id="dreawerBtn" onclick="handleDrawer()">
                        <i class="ion-navicon-round color4"></i>
                    </a>
                </div>
                <h5 style="font-weight: bold;color:#777;border: 2px solid #d6d6d6;padding: 8px">کد کاربری : <span
                            style="color: #ff4444">{{ auth()->user()->id }}</span></h5>
                <h5 style="font-weight: bold;color: #777;border: 2px solid #d6d6d6;padding: 8px">موجودی کیف پول : <span
                            style="color: #ff4444;">{{ number_format(auth()->user()->profile->money_bag) }} ریال</span>
                </h5>
                <h5 style="font-weight: bold;color: #777;border: 2px solid #d6d6d6;padding: 8px"> اعتبار هدیه
                    : <span style="color: #ff4444;">{{ number_format(auth()->user()->profile->gift_money_bag) }}
                        ریال</span></h5>
                <h5 style="font-weight: bold;color: #777;border: 2px solid #d6d6d6;padding: 8px"> اعتبار مجتمع
                    : <span style="color: #ff4444;">{{ number_format(auth()->user()->profile->complex_money_bag) }}
                        ریال</span></h5>
              <h5 style="font-weight: bold;color: #777;border: 2px solid #d6d6d6;padding: 8px">بدهی
                    : <span style="color: #ff4444;">{{ number_format(auth()->user()->profile->debt) }}
                        ریال</span></h5>
                <div id="headerLeftSide">

                    <div id="userProfile">
                        <a onclick="userPanelNameSubItemHandler(this)" id="userProfileLink">
                            <img src="{{ (auth()->user()->avatar)?asset(auth()->user()->avatar):asset("/adminAsset/img/avatar.png") }}"
                                 alt="{{ auth()->user()->name }}">
                            <span>خوش آمدید : {{ auth()->user()->name }}</span>
                            <i class="ion-arrow-down-b" style="color : #333;"></i>
                        </a>
                        <div class="userProfileContent" style="display: none">
                            <div class="userProfileWrap">
                                <a class="userProfileItemLink" href="#">
                                    <div class="userProfileItem">
                                        <i class="ion-social-usd color7 userProfileIcon"></i>
                                        <span class="userProfileText" style="font-weight: bold">موجودی کیف پول :</span>
                                        <span class="numberuserProfile" style="font-weight: bold">{{ number_format(auth()->user()->profile->money_bag) }}
                                            ریال</span>
                                    </div>
                                </a>

                                <a class="userProfileItemLink" href="{{ route('customer.moneybag.increase') }}">
                                    <div class="userProfileItem">
                                        <i class="ion-plus color8 userProfileIcon"></i>
                                        <span class="userProfileText">افزایش اعتبار</span>
                                    </div>
                                </a>

                                <a class="userProfileItemLink" href="{{ url('/logout') }}">
                                    <div class="userProfileItem">
                                        <i class="ion-log-out color6 userProfileIcon"></i>
                                        <span class="userProfileText">خروج از حساب کاربری</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!--header end-->

            <div class="col-sm-12">
                <div class="container main-content">
                    @yield('content')
                </div>

            </div>

        </div>
    </div>
</div>
  
  <div class="modal fade" id="lastModal" role="dialog" style = "background-color : rgba(0,0,0,.7)">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style = "text-align : center;">با تشکر</h4>
        </div>
        <div class="modal-body">
         <p id="modalQuestion" style = "border : none !important; line-height : 4rem;">
              سفارش شما با موفقیت انجام شد<br>
            لطفا برای ثبت نهایی و پرداخت به سبد خرید خود مراجعه فرمایید.
        </p>
        <hr>
          <h3 style="text-align:center">توجه : </h3>
<h4 style="
    line-height: 35px;
">همکار گرامی <br>در صورت بروز هرگونه مشکل در فرایند آپلود فایل با شماره های ذیل تماس حاصل فرمایید<br>02126329518 <br>02126141052</h4>

        </div>
        <div class="modal-footer">
          <div id="myModalBottonBtnSection">
            <div class="myModalBottonBtn">
                <a href="{{ route('customer.order') }}">
                    <i class="ion-refresh"></i>
                    <span>تکرار فرایند</span>
                </a>
            </div>

            <div class="myModalBottonBtn">
                <a href="{{ route('customer.cart') }}">
                    <i class="ion-eye"></i>
                    <span>مشاهده فاکتور</span>
                </a>
            </div>
        </div>
        </div>
      </div>
      
    </div>
  </div>
  
<!--
<div id="myModal1" style="display: none" class="animated fadeIn">
    <div id="modalCloseSection">
        <a id="closeBtnMyModal" onclick="closeMyModal()">
            <i class="ion-close"></i>
        </a>
    </div>
    <div id="myModalBody">
        <p id="modalQuestion">
            با تشکر . سفارش شما با موفقیت انجام شد.<br>
            لطفا برای ثبت نهایی و پرداخت به سبد خرید خود مراجعه فرمایید.
        </p>
        <div id="myModalBottonBtnSection">
            <div class="myModalBottonBtn">
                <a href="{{ route('customer.order') }}">
                    <i class="ion-refresh"></i>
                    <span>تکرار فرایند</span>
                </a>
            </div>

            <div class="myModalBottonBtn">
                <a href="{{ route('customer.cart') }}">
                    <i class="ion-eye"></i>
                    <span>مشاهده فاکتور</span>
                </a>
            </div>
        </div>
    </div>
</div>
-->
<!--===============================================================================================-->
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/tilt.jquery.js"></script>
<script src="/assets/js/alertify.js"></script>
<script src="/assets/js/jquery.smartWizard.js"></script>


<!--===============================================================================================-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  
<script>
    function handleDrawer() {
        var elm = document.getElementById("mainMenu").style.display;
        if (elm == "flex") {
            document.getElementById("mainMenu").style.display = "none";
            document.getElementById("leftSide").style.width = "100%";

        }
        else if (elm == "none") {
            document.getElementById("mainMenu").style.display = "flex";
            document.getElementById("leftSide").style.width = "80%";
        }

    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Smart Wizard
        $('#smartwizard').smartWizard({
            selected: 0,  // Initial selected step, 0 = first step
            keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
            autoAdjustHeight: true, // Automatically adjust content height
            cycleSteps: false, // Allows to cycle the navigation of steps
            backButtonSupport: true, // Enable the back button support
            useURLhash: false, // Enable selection of the step based on url hash
            lang: {  // Language variables
                next: 'بعدی',
                previous: 'قبلی'
            },
            toolbarSettings: {
                toolbarPosition: 'bottom', // none, top, bottom, both
                toolbarButtonPosition: 'right', // left, right
                showNextButton: true, // show/hide a Next button
                showPreviousButton: true, // show/hide a Previous button

            },
            anchorSettings: {
                anchorClickable: false, // Enable/Disable anchor navigation
                enableAllAnchors: false, // Activates all anchors clickable all times
                markDoneStep: true, // add done css
                enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
            },
            contentURL: null, // content url, Enables Ajax content loading. can set as data data-content-url on anchor
            disabledSteps: [],    // Array Steps disabled
            errorSteps: [],    // Highlight step with errors
            theme: 'circles',
            transitionEffect: 'slide', // Effect on navigation, none/slide/fade
            transitionSpeed: '400'
        });

    });


</script>
<script src="/assets/js/sweetalert2.all.min.js"></script>
<script src="/assets/js/sweetalert2.min.js"></script>
<script>
            @if (count($errors->success))
    var txt = "";
    @foreach ($errors->success->all() as $error)
        txt += "{{ $error }}\n";
    @endforeach
    swal({
        title: "سپاس",
        text: txt,
        type: "success",
        confirmButtonText: 'تایید',
        allowOutsideClick:false
    });
            @endif

            @if (count($errors->failed))
    var txt = "";
    @foreach ($errors->failed->all() as $error)
        txt += "{{ $error }}\n";
    @endforeach
    swal({
        title: "خطا!",
        text: txt,
        type: "error",
        confirmButtonText: "تایید",
        allowOutsideClick:false
    });
    @endif


</script>
@yield('extraScripts')
<script src="/assets/js/main.js"></script>
<script src="/assets/js/swiper.min.js"></script>  
  
  <script>
    var swiper = new Swiper('.swiper-container', {
      spaceBetween: 30,
      centeredSlides: true,
      autoplay: {
        delay: 10000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>
  
  
<!--====== final modal black background ============-->  
<script>
//  var lastmodalElem = document.getElementById("myModal1");
//  if(lastmodalElem.style.display === "block"){
//    $('body > * :not(#myModal1)').css("filter" , "blur(2px) !important");
//  }
//  else if (lastmodalElem.style.display === "none"){
//    $('body > * :not(#myModal1)').css("filter" , "blur(0) !important");
//  }
    
</script>
<!--===============================================================================================-->
</body>
</html>