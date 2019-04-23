@extends('layouts.app')

@section('content')
    <div class="container" style="padding: 0;">

        <div id="loginSection">
            <div id="signUpSection">
                <div class="ribbon-4">
                    <div class="ribbon-content">
                        <p class="ribbonTitleInner">
                            ثبت نام
                        </p>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="signUpForm" method="post" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="doubleItemSignUp">
                        <div class="doubleItemSignUpRight">
                             <span class="input input--nao">
                        <input class="input__field input__field--nao" type="text" name="name" value="{{ old('name') }}"
                               id="input-1"/>
                        <label class="input__label input__label--nao" for="input-1">
                            <span class="input__label-content input__label-content--nao">نام نام خانوادگی</span>
                        </label>
                        <svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60"
                             preserveAspectRatio="none">
                            <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
                        </svg>
                    </span>
                        </div>
                        <div class="doubleItemSignUpLeft">
                             <span class="input input--nao">
                        <label class="input__label input__label--nao" for="input-1">
                            <span class="input__label-content input__label-content--nao">جنسیت</span>
                        </label>
                                 <div style="margin-top: 3rem">
                        <input type="radio" name="gender" value="male" id="">  <label for="" style="margin-right: 5px">آقا</label>
                        <input type="radio" name="gender" value="female" id=""><label for="" style="margin-right: 5px">خانم</label>
</div>
                    </span>
                        </div>
                    </div>
                    <div class="doubleItemSignUp">
                        <div class="doubleItemSignUpRight">
                             <span class="input input--nao">
                                <input class="input__field input__field--nao" type="text" name="phone"
                                       value="{{ old('phone') }}" id="input-1"/>
                                    <label class="input__label input__label--nao" for="input-1">
                                        <span class="input__label-content input__label-content--nao">تلفن همراه</span>
                                    </label>
                                    <svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60"
                                         preserveAspectRatio="none">
                                        <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
                                    </svg>
                             </span>
                        </div>

                        <div class="doubleItemSignUpLeft">
                             <span class="input input--nao">
                        <input class="input__field input__field--nao" type="text" name="telephone"
                               value="{{ old('telephone') }}" id="input-1"/>
                        <label class="input__label input__label--nao" for="input-1">
                            <span class="input__label-content input__label-content--nao">تلفن ضروری</span>
                        </label>
                        <svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60"
                             preserveAspectRatio="none">
                            <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
                        </svg>
                    </span>
                        </div>
                    </div>
                    <div class="doubleItemSignUp">
                        <div class="doubleItemSignUpRight">
                             <span class="input input--nao">
                        <input class="input__field input__field--nao" name="email" type="email"
                               value="{{ old('email') }}" id="input-1"/>
                        <label class="input__label input__label--nao" for="input-1">
                            <span class="input__label-content input__label-content--nao">پست الکترونیکی</span>
                        </label>
                        <svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60"
                             preserveAspectRatio="none">
                            <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
                        </svg>
                    </span>
                        </div>
                        <div class="doubleItemSignUpLeft">
                             <span class="input input--nao">
                        <input class="input__field input__field--nao" name="avatar" type="file" id="input-1"/>
                        <label class="input__label input__label--nao fileLabel" for="input-1">
                            <span class="input__label-content input__label-content--nao">تصویر پروفایل</span>
                        </label>
                        <svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60"
                             preserveAspectRatio="none">
                            <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
                        </svg>
                    </span>
                        </div>
                    </div>
                    <div class="doubleItemSignUp">
                        <div class="doubleItemSignUpRight">
                         <span class="input input--nao">
                        <input class="input__field input__field--nao" name="password" type="password" id="input-1"/>
                        <label class="input__label input__label--nao" for="input-1">
                            <span class="input__label-content input__label-content--nao">رمز عبور</span>
                        </label>
                        <svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60"
                             preserveAspectRatio="none">
                            <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
                        </svg>
                    </span>
                        </div>
                        <div class="doubleItemSignUpLeft">
                             <span class="input input--nao">
                        <input class="input__field input__field--nao" type="password" name="password_confirmation"
                               id="input-1"/>
                        <label class="input__label input__label--nao" for="input-1">
                            <span class="input__label-content input__label-content--nao">تکرار رمز عبور</span>
                        </label>
                        <svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60"
                             preserveAspectRatio="none">
                            <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
                        </svg>
                    </span>
                        </div>
                    </div>
                    <div class="singleItemSignUp">
                    <span class="input input--nao">
                        <input class="input__field input__field--nao" id="input-1" name="reagent" value="{{ old('reagent') }}" />
                        <label class="input__label input__label--nao" for="input-1">
                                <span class="input__label-content input__label-content--nao">کد کاربری معرف (غیر الزامی)</span>
                            </label>
                            <svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60"
                                 preserveAspectRatio="none">
                                <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
                            </svg>

                    </span>
                    </div>


                    <div class="singleItemSignUp">
                    <span class="input input--nao">
                        <textarea class="mytextareia input__field input__field--nao" id="input-1"name="address">
                            {{ old('address') }}
                        </textarea>
                        <label class="input__label input__label--nao" for="input-1">
                                <span class="input__label-content input__label-content--nao">آدرس دقیق و ساعت کاری</span>
                            </label>
                            <svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60"
                                 preserveAspectRatio="none">
                                <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
                            </svg>

                    </span>
                    </div>

                    <button type="submit" class="formBtn">
                        <i class="ion-person-add"></i>
                        <span>ثبت نام</span>
                    </button>
                </form>
            </div>
        </div>

    </div>
@endsection
