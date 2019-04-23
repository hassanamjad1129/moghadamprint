<?php

namespace App\Listeners;

use App\Events\orderReadyDeliverySMSEvent;
use App\profile;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


class orderReadyDeliverySMSListener
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
    public function handle(orderReadyDeliverySMSEvent $event)
    {
        $url = "37.130.202.188/services.jspd";
        $profile = profile::find(User::where('email', $event->user->email)->first()->id);
        $rcpt_nm = array($profile->phone);
        $param = array
        (
            'uname' => 'مقدم چاپ',
            'pass' => '22501792',
            'from' => '100020400',
            'message' => "مجتمع چاپ مقدم\nسفارش فاکتور : ".$event->orderItem->id."\nآماده تحویل میباشد\nلطفا جهت ارسال محصول به پنل کاربریتان در قسمت (ارسال به شهرستان) دستور ارسال به باربری را ثبت نمایید",
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
