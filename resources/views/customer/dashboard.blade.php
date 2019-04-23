@extends('customer.layouts.master')
@section('content')
<style>
  .swiper-slide img{
    width:100%
  }
  div#myModal3 {
    background-color: rgba(0,0,0,.79);
}
</style>
<div class="swiper-container">
    <div class="swiper-wrapper">
      @foreach($slideshows as $slideshow)
        <div class="swiper-slide">
          <img src="{{ asset($slideshow->picture) }}" alt="">
        </div>
      @endforeach
      
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
    <section class="content-header">
        <h2>مشخصات مشتری {{ auth()->user()->name }}</h2>
    </section>
    <!-- Main content -->
    <section class="content col-md-12">
      
        <div class="box">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="box-body">
                    <div class="col-md-9">
                        <div class="col-md-6" style="padding: 1rem">
                            <label for="id">کد کاربری</label>
                            <input type="text" disabled="disabled" name="id" id="id" class="form-control"
                                   value="{{ auth()->user()->id }}"/>
                        </div>

                        <div class="col-md-6" style="padding:1rem">
                            <label for="gender">جنسیت</label>
                            <div class="clearfix"></div>

                            <input type="radio" name="gender" disabled id="male"
                                   value="male" {{ auth()->user()->profile->gender=='male'?"checked":"" }}/>
                            <label for="male">آقا</label>

                            <input type="radio" name="gender" disabled id="female"
                                   value="female" {{ auth()->user()->profile->gender=='female'?"checked":"" }}/>
                            <label for="female">خانم</label>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6" style="padding: 1rem">
                            <label for="name">نام و نام خانوادگی</label>
                            <input type="text" name="name" id="name" disabled class="form-control"
                                   value="{{ auth()->user()->name }}"/>
                        </div>
                        <div class="col-md-6" style="padding: 1rem">
                            <label for="email">پست الکترونیکی</label>
                            <input type="text" name="email" id="email"  class="form-control"
                                   value="{{ auth()->user()->email }}">
                        </div>
                        <div class="col-md-6" style="padding: 1rem">
                            <label for="">شماره تماس ضروری</label>
                            <input type="text" name="phone" value="{{ auth()->user()->profile->telephone }}" id=""
                                   class="form-control">
                        </div>

                        <div class="col-md-6" style="padding: 1rem">
                            <label for="">شماره همراه</label>
                            <input type="text" name="telephone" value="{{ auth()->user()->profile->phone }}" id=""
                                   class="form-control">
                        </div>
                        <div class="col-md-6" style="padding: 1rem">
                              <label for="">رمز عبور جدید</label>
                              <input type="password" name="password" value="" id=""
                                     class="form-control">
                        </div>

                        <div class="col-md-6" style="padding: 1rem">
                            <label for="">تکرار رمز عبور جدید</label>
                            <input type="password" name="password_confirmation" id="" class="form-control" />
                        </div>
                      
                    </div>
                    <div class="col-md-3">
                        <img src="{{ auth()->user()->avatar?asset(auth()->user()->avatar):"/adminAsset/img/avatar.png" }}" class="img-responsive img-circle">
                        <input type="file" name="picture" id="" class="form-control"/>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-md-12">
                        <label for="">آدرس</label>
                        <textarea name="address" class="form-control" id="" cols="30"
                                  rows="4">{{ auth()->user()->profile->address }}</textarea>
                    </div>
                    <div class="col-md-12" style = "padding-bottom : 4rem;">
                        <button class="btn btn-success" style="margin-top: 5px">بروزرسانی</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      
      </div>
      <div class="modal-body">
        <img src="/firefox.png" style="width:100%"/>
      </div>
    </div>

  </div>
</div>
<script>  
  document.getElementsByClassName("swiper-container")[0].parentElement.style.padding = 0 ;
  
</script>
@endsection
@section('extraScripts')
<script>
$("#myModal3").modal()
</script>
@endsection