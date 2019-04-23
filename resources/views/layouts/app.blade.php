<!DOCTYPE html>
<html lang="fa-IR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="title" content="مجتمع تبلیغاتی مقدم چاپ">
    <meta name="description" content="مجتمع تبلیغاتی مقدم چاپ عرضه کننده انواع تابلو های تبلیغاتی ، چاپ افست ، دیجیتال مارکتینگ ، ماشین آلات چاپی می باشد . چاپخانه مقدم چاپ با بهره گیری از بهترین و بروزترین ماشین آلات چاپ در خدمت مشتریان می باشد.">
    <meta name="keywords" content="مقدم چاپ,تراکت مقدم چاپ,تابلو سازی مقدم,مجتمع مقدم چاپ,کارت ویزیت مقدم">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Persian"><title>مجتمع تبلیغاتی مقدم چاپ</title>
    <link type="text/css" rel="stylesheet" href="/assets/css/ionicons.min.css">
    <link type="text/css" rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="/assets/css/bootstrap-rtl.min.css">
    <link type="text/css" rel="stylesheet" href="/assets/css/animate.min.css">
    <link type="text/css" rel="stylesheet" href="/assets/css/main.css">
     
    <script type="text/javascript" src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/tilt.jquery.min.js"></script>
    <script type="text/javascript" src="/assets/js/main.js"></script>

    @yield('extraStyle')
</head>
<body>

<a href="{{ asset($priceList) }}" target="_blank" id="offerBtn">
    <p style ="font-size : 1.4rem">لیست قیمت ویژه همکاران</p>
</a>
<a href="#" id="smsBtn" data-toggle="modal" data-target="#smsModal">
    <p style ="font-size : 1.4rem;color:#FFF">معرفی با پیامک</p>
</a>
<!-- Modal -->


@yield('extraContent')
<div id="pageTop">
    <div class="container topPageInner">
        <div id="pageTopRightSide" class="animated fadeInRight">
            <div class="topNum">

                <span>۰۲۱ - ۲۶۳۲۹۵۱۸</span>
                <i class="ion-ios-telephone"></i>
            </div>
            <div class="topNum">

                <span>۰۹۳۳ - ۶۳۳۳۵۳۶</span>
                <i class="ion-iphone"></i>
            </div>
        </div>
        <div id="loginTopSection">
            @if(Auth::guest())
                <a href="/login">
                    <i class="ion-log-in"></i>
                    <span>ورود همکاران</span>
                </a>
                <a href="/register">
                    <i class="ion-android-person-add"></i>
                    <span>ثبت نام</span>
                </a>
            @else
                @if(auth()->user()->level=='admin')
                <a href="/admin">
                    <i class="ion-ios-person"></i>
                    <span>پنل مدیریت</span>
                </a>
                @else
                    <a href="/customer">
                        <i class="ion-ios-person"></i>
                        <span>پروفایل کاربری</span>
                    </a>
                @endif
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button>
                        <i class="ion-log-out"></i>
                        <span>خروج</span>
                    </button>
                </form>

            @endif
        </div>

    </div>
</div>
<div class="menuSection container">
    <div class="myMenu">
        <div class="ribbon-2 animated fadeInLeft">
            <div id="mainMenu">
                <a href="/" class="menuItem">
                    <span>خانه</span>
                    <i class="ion-android-home"></i>
                </a>

                <a href="{{ url('pre-order') }}" class="menuItem">
                    <span>سامانه فروش آنلاین</span>
                    <i class="ion-bag"></i>
                </a>
                <a href="/representations" class="menuItem">
                    <span>نمایندگان</span>
                    <i class="ion-ios-people"></i>
                </a>

                <a href="{{ url('about-us') }}" class="menuItem">
                    <span>درباره ما</span>
                    <i class="ion-document-text"></i>
                </a>
                <a href="{{ url('contact-us') }}" class="menuItem">
                    <span>تماس با ما</span>
                    <i class="ion-android-call"></i>
                </a>
            </div>
        </div>
    </div>
 
    <div id ="smallMenu" style = "display : none;">
        <div class = "smallMenuItem">
            <a href="/" class="menuItem">
                <span>خانه</span>
                <i class="ion-android-home"></i>
            </a>
        </div>
        <div class = "smallMenuItem">
           <a href="{{ url('pre-order') }}" class="menuItem">
              <span>سامانه فروش آنلاین</span>
              <i class="ion-bag"></i>
           </a>
        </div>
        <div class = "smallMenuItem">
            <a href="/representations" class="menuItem">
                <span>نمایندگان</span>
                <i class="ion-ios-people"></i>
             </a>
        </div>
        <div class = "smallMenuItem">
          <a href="{{ url('about-us') }}" class="menuItem">
              <span>درباره ما</span>
              <i class="ion-document-text"></i>
          </a>
        </div>
        <div class = "smallMenuItem">
          <a href="{{ url('contact-us') }}" class="menuItem">
             <span>تماس با ما</span>
             <i class="ion-android-call"></i>
          </a>
        </div>
      
    </div>
  
   <div id = "drawerButton" onclick = "drawerButtonHandler()" >
      <i class = "ion-navicon"></i>
  </div>
  
  
    <div id="logoSection" class="animated fadeInRight">
        <a href="#">
            <img src="/assets/img/nwLogo.png" alt="">
        </a>
    </div>
</div>
@yield('content')
<div id="mainFooter">
    <div id="mainFooterInner" class="container">
        <div class="mainFooterSection">
            <span class="ribbon5">
                <div class="footerRibbonInner">
                    <p>اطلاعات تماس</p>
                </div>
            </span>
            <div id="footerContactInfoSection">
              
               
              
               <div class="footerContactInfoItem">
                    <i class="ion-android-call"></i>
                    <span>۰۲۱ - ۲۶۳۲۹۵۱۸</span>
                </div>
              
               <div class="footerContactInfoItem">
                    <i class="ion-paper-airplane"></i>
                    <span>۰۹۳۳ - ۶۳۳۳۵۳۶</span>
                </div>
               
                <div class="footerContactInfoItem">
                    <i class="ion-iphone"></i>
                    <span>۰۹۱۲ - ۶۰۹۰۸۵۵</span>
                </div>
              
              
                <div class="footerContactInfoItem">
                    <i class="ion-android-mail"></i>
                    <span style= "font-size : 1.2rem">info@moghadamprint.com</span>
                </div>
                <div class="footerContactInfoItem">
                    <i class="ion-ios-location"></i>
                    <span>مجیدیه جنوبی - خیابان امیری - جنب مسجد محمدی - پلاک 49</span>
                </div>
            </div>
        </div>
        <div class="mainFooterSection">
            <span class="ribbon5">
                 <div class="footerRibbonInner">
                    <p>نماد الکترونیک</p>
                </div>
            </span>
            <div id="footerNamadSectrion">
              <a href="https://www.zarinpal.com/trustPage/moghadamprint.com" target="_blank" title="دروازه پرداخت معتبر"><img src="/assets/img/1.png" border="0" alt="دروازه پرداخت معتبر"></a>
            </div>
        </div>
        <div class="mainFooterSection">
            <span class="ribbon5">
                 <div class="footerRibbonInner">
                    <p>دسترسی سریع</p>
                </div>
            </span>
            <div id="footerQuikAccessSecrtion">
                <div class="footerQuikAccessItem">
                    <a href="{{ url('policies') }}" class="footerQuikAccessItemLink item11">
                        <i class="ion-ios-book"></i>
                        <span>قوانین و مقررات</span>
                    </a>
                </div>

                <div class="footerQuikAccessItem">
                    <a href="{{ url('pre-order') }}" class="footerQuikAccessItemLink item12">
                        <i class="ion-card"></i>
                        <span>ثبت سفارش آنلاین</span>
                    </a>
                </div>

                <div class="footerQuikAccessItem">
                    <a href="{{ url('representations') }}" class="footerQuikAccessItemLink item13">
                        <i class="ion-ios-people"></i>
                        <span>نمایندگان</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="mainFooterSection">
           <span class="ribbon5">
                <div class="footerRibbonInner">
                    <p>درباره ما</p>
                </div>
           </span>
            <p id="footerAboutUsItem">

                مجتمع تبلیغات مقدم چاپ در سال 1390 شروع به فعالیت خود در عرصه تابلوسازی (برند نوین الکترونیک ) و چاپ برروی اجسام نمود و پس از گذشت 2سال توانست به یک مجموعه بزرگ تابلوسازی تبدیل گردد و در طی 3 سال حضور مداوم در عرصه تبلیغات توانست واحدهای فرم بندی افست خود را افتتاح کند و هم اکنون طی گذشت 3 سال توانسته است مطابق با نیازهای مشریان خود گام بردارد امیدواریم بتوانیم نسبت به نیاز شما مشتریان عزیز گام موثری برداریم.            </p>
        </div>
    </div>
</div>
<div id="myfooter">
    <div class="container" id="footerInner">
        <div id="copyRight">
            <span>© ۱۳۹۷ تمامی حقوق برای مجتمع تبلیغاتی مقدم محفوظ است . </span>
            <a href="https://hugenet.ir">طراحی وبسایت</a>
            <span>و اجرا توسط</span>
            <a href="https://hugenet.ir/%D8%AA%D9%85%D8%A7%D8%B3-%D8%A8%D8%A7-%D9%85%D8%A7/">ایده پردازان تدبیر بنیان</a>
        </div>
        <div id="pageTopLeftSide" class="animated fadeInLeft">
            <a href="{{$linkInstagram}}" target="_blank" class="topSocialItem insta">
                <i class="ion-social-instagram"></i>
            </a>
            <a href="{{$linkTelegram}}" target="_blank" class="topSocialItem telegram">
                <i class="ion-ios-paperplane"></i>
            </a>
        </div>
    </div>

</div>

<div class="m-backtotop" aria-hidden="true" onclick = jumpToTop()>
    <div class="arrow">
        <i class="ion-arrow-up-c"></i>
    </div>
    <div class="text">
        بالا
    </div>
</div>
<div id="smsModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md" style="width:40%">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <form action="" method="post">
          @csrf
          <center><img src="/assets/img/nwLogo.png" alt="" style="width:100px"></center>
          <h4 style="margin:10px 0;text-align: center;"> از اینکه سایت ما را به دوستان خود معرفی می کنید بسیار سپاسگزاریم.</h4>
          <table class="" style="width:100%">
            <tr>
              <td class="col-md-6 col-xs-12" style="color: #e91d25;">نام گیرنده</td>
              <td class="col-md-6 col-xs-12"><input type="text" name="to_name" id="" class="form-control" style="margin: 3px 0;"></td>
            </tr>
            <tr>
              <td class="col-md-6 col-xs-12" style="color: #e91d25;">موبایل گیرنده<span style="color:#111">(*)</span></td>
              <td class="col-md-6 col-xs-12"><input type="text" name="to_number" id="" class="form-control" style="margin: 3px 0;"></td>
            </tr>
            <tr>
              <td class="col-md-6 col-xs-12" style="color: #e91d25;">نام شما</td>
              <td class="col-md-6 col-xs-12"><input type="text" name="from_name" id="" class="form-control" style="margin: 3px 0;"></td>
            </tr>
          </table>
          <button class="btn btn-danger" style="width: 40%;background: #de1d24e6;">ارسال</button>
        </form>
      </div>
    </div>

  </div>
</div>


<script type="text/javascript" src="/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/tilt.jquery.js"></script>
<script type="text/javascript" src="/assets/js/main.js"></script>
<script src="/assets/js/swiper.min.js"></script>
<script>var swiper = new Swiper('.swiper-container', {pagination: {el: '.swiper-pagination',type: 'progressbar',},navigation: {nextEl: '.swiper-button-next',prevEl: '.swiper-button-prev',},autoplay: {delay: 10000,disableOnInteraction: false,}});</script>
<script>$('.js-tilt').tilt({scale: 1,glare: false,perspective: 90,maxTilt : 25,speed:300,transition:true});</script>

</body>
</html>