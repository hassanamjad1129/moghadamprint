<?php

namespace App\Listeners;

use App\Events\adminRegisterSMSEvent;
use App\profile;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\notification;


class adminRegisterSMSListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  registerSMSEvent $event
     * @return void
     */
    public function handle(adminRegisterSMSEvent $event)
    {
        $url = "37.130.202.188/services.jspd";
        $profile = profile::find(User::where('email', $event->user->email)->first()->id);
        $rcpt_nm = array($profile->phone);
        $param = array
        (
            'uname' => 'مقدم چاپ',
            'pass' => '22501792',
            'from' => '100020400',
            'message' => "مجتمع چاپ مقدم ( افست )\nویژه همکاران\nهمکار گرامی : ".($profile->gender=='male'?'آقای ':'خانم ') . $event->user->name."\n"."مفتخریم شما را عضوی از خانواده بزرگ مقدم چاپ داشته باشیم
\nثبت نام اتوماتیک با موفقیت انجام شد\nنام کاربری : ".$profile->phone."\n رمز عبور موقت :123456\nمقدم چاپ اولین چاپخانه با ارسال رایگان در ایران\nوبسایت \n www.moghadamprint.com
\nشماره تماس : \n02126329518\n02126141052",
            'to' => json_encode($rcpt_nm),
            'op' => 'send'
        );

        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response2 = curl_exec($handler);
    }
}
