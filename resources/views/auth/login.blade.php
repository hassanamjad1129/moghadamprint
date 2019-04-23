@extends('layouts.app')

@section('content')
    <div class="container" style="padding: 0;">

        <div id="loginSection">
            <div id="loginSectionRightSide">
                <img src="/assets/img/login.png" alt="">
                <div>
                    <i class="ion-card"></i>
                    <span>مناسب ترین قیمت</span>
                </div>
                <div>
                    <i class="ion-android-car"></i>
                    <span>تحویل در اسرع وقت</span>
                </div>
                <div>
                    <i class="ion-android-checkmark-circle"></i>
                    <span>مواد اولیه با کیفیت</span>
                </div>
            </div>
            <div id="loginSectionLeftSide">

                <form action="" id="loginForm" method="post">
                    @csrf
                    <div class="ribbon-4">
                        <div class="ribbon-content">
                            <p class="ribbonTitleInner">
                                ورود به حساب کاربری
                            </p>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger" style="margin-top: 4rem">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <section class="content bgcolor-1">
                        <span class="input input--nao">
					<input class="input__field input__field--nao" type="text" name="email" id="input-1"/>
					<label class="input__label input__label--nao" for="input-1">
						<span class="input__label-content input__label-content--nao">نام کاربری</span>
					</label>
					<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60"
                         preserveAspectRatio="none">
						<path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
					</svg>
				</span>
                        <span class="input input--nao">
					<input class="input__field input__field--nao" type="password" name="password" id="input-2"/>
					<label class="input__label input__label--nao" for="input-2">
						<span class="input__label-content input__label-content--nao">رمز عبور</span>
					</label>
					<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60"
                         preserveAspectRatio="none">
						<path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
					</svg>
				</span>
                      <div class="col-md-12">
                        <div class="form-group">
                            
                                <div class="checkbox">
                                    <label style="font-size: 18px;">
                                        <input type="checkbox" style="width: 17px;height: 17px;margin: 0 -20px;" name="remember"> مرا به خاطر بسپار
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="formBtn">
                            <i class="ion-log-in"></i>
                            <span>ورود به حساب کاربری</span>
                        </button>
                    </section>
                </form>
                <div id="forgetOrSignUp">
                    <a href="/register">حساب کاربری ندارید ؟ ثبت نام</a>
                    <br>
                    <a href="{{ url('/password/reset') }}">رمز عبور خود را فراموش کرده اید ؟</a>
                </div>
            </div>
        </div>

    </div>

@endsection
