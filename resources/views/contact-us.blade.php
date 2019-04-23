@extends('layouts.app')
@section('content')
    <div class="container" style="padding: 0;">

        <div id="loginSection" style="width: 100%; margin-top: 1rem">
            <div id="signUpSection">
                <div class="ribbon-4">
                    <div class="ribbon-content">
                        <p class="ribbonTitleInner">
                            تماس با مجتمع تبلیغاتی مقدم
                        </p>
                    </div>
                </div>

                <div id="contactUsFirstSection">
                    <div id="contactWays">
                        <div id="contactsWayInner">
                            <div id="address">
                                <i class="ion-ios-location"></i>
                                <span>
مجیدیه جنوبی - خیابان امیری - جنب مسجد محمدی - پلاک 49</span>
                            </div>
                            <div id="phoneNum">
                                <div id="phoneIcon">
                                    <i class="ion-iphone"></i>
                                </div>
                                <div id="phoneNums">
                                    <p>021 - 26 32 95 18 </p>
                                    <p>021 - 26 14 10 52</p>
                                    <p>0912 - 60 90 855</p>

                                </div>
                            </div>
                            <div id="email">
                                <i class="ion-email"></i>
                                <span>info@moghadamprint.com</span>
                            </div>
                            <div id="contactusSocailItems">
                                <div class="contactusSocailItem">
                                    <a href="https://t.me/servermoghadam" class="contactusSocailItemLink">
                                        <i class="ion-paper-airplane"></i>
                                    </a>
                                </div>
                                <div class="contactusSocailItem">
                                    <a href="https://instagram.com/moghadamprint" class="contactusSocailItemLink">
                                        <i class="ion-social-instagram"></i>
                                    </a>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div id="contactFormSection">
                        <div class="ribbon-2 animated fadeInLeft" style="width: auto; margin-top: 2rem; z-index: 99999">
                            <div id="contactUsRibbonInner">فرم ارتباط با مجموعه</div>
                        </div>
                        <div id="contactUsFormDiv">
                            <form id="contactUs">

                                <div class="doubleItemSignUp">
                                    <div class="doubleItemSignUpRight">
                             <span class="input input--nao">
                        <input class="input__field input__field--nao" type="text" id="input-1"/>
                        <label class="input__label input__label--nao" for="input-1">
                            <span class="input__label-content input__label-content--nao">نام</span>
                        </label>
                        <svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60"
                             preserveAspectRatio="none">
                            <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
                        </svg>
                    </span>
                                    </div>
                                    <div class="doubleItemSignUpLeft">
                             <span class="input input--nao">
                        <input class="input__field input__field--nao" type="text" id="input-2"/>
                        <label class="input__label input__label--nao" for="input-2">
                            <span class="input__label-content input__label-content--nao">نام خانوادگی</span>
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
                        <input class="input__field input__field--nao" type="text" id="input-3"/>
                        <label class="input__label input__label--nao" for="input-3">
                            <span class="input__label-content input__label-content--nao">پست االکترونیک</span>
                        </label>
                        <svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60"
                             preserveAspectRatio="none">
                            <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
                        </svg>
                    </span>
                                    </div>
                                    <div class="doubleItemSignUpLeft">
                             <span class="input input--nao">
                        <input class="input__field input__field--nao" type="text" id="input-4"/>
                        <label class="input__label input__label--nao" for="input-4">
                            <span class="input__label-content input__label-content--nao">شماره تلفن</span>
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
                         <textarea class="mytextareia input__field input__field--nao" type="text"
                                   id="input-5"/> </textarea>
                        <label class="input__label input__label--nao" for="input-5">
                                <span class="input__label-content input__label-content--nao">پیام ارزشمند شما</span>
                            </label>
                            <svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60"
                                 preserveAspectRatio="none">
                                <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
                            </svg>

                    </span>
                                    <button class="btn btn-danger" style="font-family: Yekan">ارسال</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection