<?php

namespace App\Listeners;

use App\Events\finishedOrderEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\profile;

class finishedOrderListener
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
     * @param  finishedOrderEvent  $event
     * @return void
     */
    public function handle(finishedOrderEvent $event)
    {
        $url = "37.130.202.188/services.jspd";
        $profile = profile::find($event->order->user->id);
        $rcpt_nm = array($profile->phone);
        $param = array
        (
            'uname' => 'مقدم چاپ',
            'pass' => '22501792',
            'from' => '100020400',
            'message' => "مجتمع چاپ مقدم\nسفارش فاکتور : ".$event->order->id."\n".($event->type?
                                                                                   "تحویل نهایی شد"
                                                                                   :"آماده تحویل است\nلطفا  جهت ارسال محصول به پنل کاربریتان در قسمت  (درخواست ارسال ) دستور ارسال به باربری را ثبت نمایید"),
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
    }
}
