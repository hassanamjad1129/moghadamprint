<?php

namespace App\Listeners;

use App\Events\verifyOrderEvent;
use App\profile;
use App\User;
use App\notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class verifyOrderListener
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
    public function handle(verifyOrderEvent $event)
    {
        $url = "37.130.202.188/services.jspd";
        $profile = profile::find($event->user->id);
        $rcpt_nm = array($profile->phone);
        $param = array
        (
            'uname' => 'مقدم چاپ',
            'pass' => '22501792',
            'from' => '100020400',
            'message' => ("مجتمع مقدم چاپ\nشماره فاکتور:".$event->item->id."\nنوع سفارش :".$event->item->product->subcategory->category->name.'،'.$event->item->product->subcategory->name."\nابعاد : ".$event->item->product->name."\nنوع کار :".($event->item->type=="single"?"یک رو":"دو رو")."\nسرعت چاپ : ".($event->item->speed=="fast"?"فوری":"عادی") . 
                          "\nمبلغ سفارش :".(number_format($event->item->unit_price*$event->item->lats*$event->item->qty))." ریال"."\nتاریخ ثبت سفارش :".jdate()->format('Y/m/d H:i')),
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
        $notification->category="order";
        $notification->description="سفارش جدید به شماره ".$event->item->id." به مبلغ : ".(number_format($event->item->unit_price*$event->item->lats*$event->item->qty))." ریال ثبت شد";
        $notification->link=route("admin.order.detail",[$event->item->id]);
        $notification->save();
    }
}
