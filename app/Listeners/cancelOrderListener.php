<?php

namespace App\Listeners;

use App\Events\cancelOrderEvent;
use App\profile;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class cancelOrderListener
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
    public function handle(cancelOrderEvent $event)
    {
        $url = "37.130.202.188/services.jspd";
        $profile = profile::find($event->user->id);
        $rcpt_nm = array($profile->phone);
        $param = array
        (
            'uname' => 'مقدم چاپ',
            'pass' => '22501792',
            'from' => '100020400',
            'message' => "مجتمع چاپ مقدم\nسفارش فاکتور : ".$event->item->id."\nدر تاریخ: ".jdate(strtotime($event->item->created_at))->format("Y/m/d H:i")."\nاز حساب شما حذف و مبلغ به پنل کاربریتان واریز گردید",
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
