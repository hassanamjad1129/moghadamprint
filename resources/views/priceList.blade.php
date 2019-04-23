@extends('layouts.app')
@section('content')
<style>
.table > tbody > tr:hover{
            transform: scale(1.02);
            transition: all 0.3s ease 0s;
        }
    .table td{
            cursor: default;
        }
  
        .table > tbody > tr:nth-child(2n+1) > td {
            background-color: #FFF;
            color: #000;

        }
        .table > tbody > tr:hover{
            transform: scale(1.02);
            transition: all 0.3s ease 0s;
        }
        .table > tbody > tr:nth-child(2n) > td {
            background-color: #DDD;
            color: #000;

        }

        .table > tbody > tr > td {
            padding: 10px !important;
            border: none;
            text-align: center;
          
        }
  
</style>
<script>
       $(document).ready(function () {
            $(".table tr").each(function () {
                var txt=$(this).children('td:first').text();
                if (isNaN(txt) && !($(this).children('td:nth-child(2)').text())) {
                    $(this).html("<td colspan='16'>"+txt+"</td>");
                    $(this).children('td').css({
                        'color':'#FFF',
                        'background':"rgb(255, 68, 68)",
                        'text-align':'center',
                        'font-size':'18px'
                    })
                }
            });
            $(".table tr").each(function () {
                var txt=$(this).children('td:first').text();
                if(!(txt)){
                  $(this).remove();  
                }
            });
        });
    </script>
    
  <div id="mySlider" class="container">
        <div class="swiper-container">
            <div class="swiper-wrapper">
              
                
              @foreach($category->slideshows as $slideshow)
                <div class="swiper-slide">
                    <img src="{{ asset($slideshow->picture) }}" alt="">
                    <div class="sliderHalf">
                        <div class="ribbon-3  animated fadeInRightBig">
                            <div class="ribbon3Inner">
                                <p>{{ $name }}</p>
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


<div class="container" style="padding: 0;">

    <div class="container" style="padding: 0;">

        <div id="mainContentTitle" style=" background-image: url(/assets/img/loginBack.png); background-repeat: repeat; ">
            <div class="ribbon-4">
                <div class="ribbon-content">
                    <p class="ribbonTitleInner">
                       لیست قیمت {{ $name }}</p>
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
          {!! $data !!}
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
        delay: 4000,
        disableOnInteraction: false,
        }
    });
</script>
@endsection