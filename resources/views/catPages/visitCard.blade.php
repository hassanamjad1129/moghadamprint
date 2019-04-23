@extends('layouts.app')
@section('content')


  <div id="mySlider" class="container">
        <div class="swiper-container">
            <div class="swiper-wrapper">
              
                <div class="swiper-slide">
                    <img src="/assets/img/sampleForAll.jpg" alt="">
                    <div class="sliderHalf">
                        <div class="ribbon-3  animated fadeInRightBig">
                            <div class="ribbon3Inner">
                                <p>مجتمع تبلیغاتی مقدم</p>
                            </div>
                        </div>
                    </div>
                </div>
              
              <div class="swiper-slide">
                    <img src="/assets/img/visitCard.jpg" alt="">
                    <div class="sliderHalf">
                        <div class="ribbon-3  animated fadeInRightBig">
                            <div class="ribbon3Inner">
                                <p>طراحی و چاپ کارت ویزیت ساده</p>
                            </div>
                        </div>
                    </div>
                </div>
              
              <div class="swiper-slide">
                    <img src="/assets/img/visitCard.jpg" alt="">
                    <div class="sliderHalf">
                        <div class="ribbon-3  animated fadeInRightBig">
                            <div class="ribbon3Inner">
                                <p>طراحی و چاپ کارت های ویزیت فانتزی</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
 </div>


<div class="container" style="padding: 0;">

    <div class="container" style="padding: 0;">

        <div id="mainContentTitle" style=" background-image: url(/assets/img/loginBack.png); background-repeat: repeat; ">
            <div class="ribbon-4">
                <div class="ribbon-content">
                    <p class="ribbonTitleInner">
                       لیست قیمت
                    </p>
                </div>
            </div>
            <div class="deviderLine animated zoomIn"></div>
        </div>
    </div>

</div>


<div class="container" style="padding: 0;">

    <div class="container" style="padding: 0;">

        <div class="mainContentTitle" style=" background-image: url(/assets/img/loginBack.png); background-repeat: repeat; margin-bottom: 2rem; padding-top: 0 ; border-bottom: 1px solid #ccc">
         
          
        <div style = "width : 100%; display : flex ; flex-directoin : row; justify-content : center ; align-items : center; padding-top : 2rem ; padding-bottom : 2rem" class = "myPricesListImage">
          <img style = "width : 90%; border : 2px solid #ccc;" src="/assets/img/newvisitph.png" alt="">
        </div>
          
          
          
            <div id="callForpepresentations" style="margin-top: 3rem">
                <a href="https://t.me/servermoghadam">
                    <i class="ion-paper-airplane"></i>
                    <span>لطفا جهت سفارش کلیک کنید</span>
                </a>
            </div>
        </div>
    </div>

</div>

<script>
    var swiper = new Swiper('.swiper-container', {
        pagination: {
            el: '.swiper-pagination',
            type: 'progressbar',
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
       autoplay: {
        delay: 6000,
        disableOnInteraction: false,
        }
    });
</script>
@endsection