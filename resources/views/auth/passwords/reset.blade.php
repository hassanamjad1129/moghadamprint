@extends('layouts.app')

@section('content')
    <div class="container" style="padding: 0;">

        <div id="loginSection">
            <div id="loginSectionRightSide">
                <img src="../assets/images/login.png" alt="">
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
                <form role="form" method="POST" action="{{ url('/password/reset') }}" id="loginForm">
                    <div class="ribbon-4">
                        <div class="ribbon-content">
                            <p class="ribbonTitleInner">
                                رمز عبور جدید وارد کنید
                            </p>
                        </div>
                    </div>
                    <section class="content bgcolor-1" style="margin-top: 2rem">
                    <span class="input input--nao">
					<input class="input__field input__field--nao" type="email" name="password" id="input-1"/>
					<label class="input__label input__label--nao" for="input-1">
						<span class="input__label-content input__label-content--nao">پست الکترونیکی</span>
					</label>
					<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60"
                         preserveAspectRatio="none">
						<path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
					</svg>
				</span>
                        <span class="input input--nao">
					<input class="input__field input__field--nao" type="password" name="password" id="input-1"/>
					<label class="input__label input__label--nao" for="input-1">
						<span class="input__label-content input__label-content--nao">رمز عبور</span>
					</label>
					<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60"
                         preserveAspectRatio="none">
						<path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
					</svg>
				</span>

                        <span class="input input--nao">
					<input class="input__field input__field--nao" type="password" name="password_confirmation"
                           id="input-2"/>
					<label class="input__label input__label--nao" for="input-2">
						<span class="input__label-content input__label-content--nao">تکرار رمز عبور</span>
					</label>
					<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60"
                         preserveAspectRatio="none">
						<path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
					</svg>
				</span>
                        <button type="submit" class="formBtn" style="margin-top: 6rem">
                            <i class="ion-log-in"></i>
                            <span>بازنشانی رمز</span>
                        </button>
                    </section>
                </form>
            </div>
        </div>

    </div>
@endsection
