<?php

namespace App\Listeners;

use App\Events\registerSMSEvent;
use App\profile;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\notification;


class registerSMSListener
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
    public function handle(registerSMSEvent $event)
    {
        $url = "37.130.202.188/services.jspd";
        $profile = profile::find(User::where('email', $event->user->email)->first()->id);
        $rcpt_nm = array($profile->phone);
        $param = array
        (
            'uname' => 'مقدم چاپ',
            'pass' => '22501792',
            'from' => '100020400',
            'message' => "مجتمع مقدم چاپ\nثبت نام شما با موفقیت انجام شد\nبه جمع خانواده بزرگ مقدم چاپ خوش آمدید.\nکد کاربری شما : " . $profile->user_id,
            'to' => json_encode($rcpt_nm),
            'op' => 'send'
        );

        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response2 = curl_exec($handler);

        $response2 = json_decode($response2);
        $res_code = $response2[0];
        $res_data = $response2[1];
        
        $notification=new notification();
        $notification->category="register";
        $notification->description="کاربر جدید با کد کاربری : ".$profile->user_id." در انتظار تایید است";
        $notification->link=route("customers.show",[$profile->user_id]);
        $notification->save();
    }
}
