<?php

namespace App\Listeners;

use App\Events\deliveredOrderEvent;
use App\profile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class deliveredOrderListener
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
     * @param  deliveredOrderEvent $event
     * @return void
     */
    public function handle(deliveredOrderEvent $event)
    {
        $url = "37.130.202.188/services.jspd";
        $profile = profile::find($event->order->user_id);
        $rcpt_nm = array($profile->phone);
        $param = array
        (
            'uname' => 'مقدم چاپ',
            'pass' => '22501792',
            'from' => '100020400',
            'message' => "مجتمع مقدم چاپ\nفاکتور " . $event->order->id . " تحویل باربری گردید.\nبرای اطلاع از ارسال محصول به آرشیو سفارشات خود مراجعه کنید",
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
