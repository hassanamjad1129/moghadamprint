<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\orderItem;
use App\order;
use App\Events\cancelOrderEvent;
use App\Events\finishedOrderEvent;
use App\Events\deliveredOrderEvent;
use App\Events\stoppedOrderEvent;
use App\profile;
use App\User;
use App\moneybagReport;
use App\Jobs\orderSubmit;
use Carbon\Carbon;
use App\Events\orderReadyDeliverySMSEvent;

class orderController extends Controller
{
    public function inCompleteOrders()
    {
        $orders = orderItem::where(function($query){
          $query->where('order_items.status', '<=', 7)->orWhere('order_items.status', 9);
        })->where('order_items.verified', 1)->join('orders', 'order_items.order_id', '=', 'orders.id')->orderBy('orders.created_at', 'desc')->select(['order_items.*'])->get();
        return view('admin.orders.incomplete', [
            'orders' => $orders
        ]);
    }

    public function completedOrders()
    {
        $orders = orderItem::where('order_items.status', '>', 7)->where('order_items.status','<>' ,9)->where('order_items.verified', 1)->join('orders', 'order_items.order_id', '=', 'orders.id')->orderBy('orders.created_at', 'desc')->select(['order_items.*'])->get();
        return view('admin.orders.orders', [
            'orders' => $orders
        ]);
    }

    public function orderDetail(orderItem $order)
    {
        return view('admin.orders.detail', [
            'order' => $order
        ]);
    }


    public function updateOrderDetail(orderItem $order, Request $request)
    {
        $order->status = $request->status;
        if ($request->status > 6) {
            if ($request->address == "تحویل در چاپخانه" and $request->status == 7) {
                event(new finishedOrderEvent($order, 0));
            } elseif ($request->status == 8) {
                event(new finishedOrderEvent($order, 1));
            } elseif ($request->status == 10) {
                event(new deliveredOrderEvent($order));
            } elseif ($request->status == 9) {
                event(new stoppedOrderEvent($order));
            }
        }
        $order->delivery_location=$request->delivery_location;
        $order->delivery_state=$request->delivery_state;
        $order->delivery_number=$request->delivery_number;
        $order->delivery_sender=$request->delivery_sender;

        if ($request->status == 3) {
            if ($order->speed == 'fast') {
                $time = $order->product->fast_delivery;
            } else {
                $time = $order->product->normal_delivery;
            }
            $now = Carbon::now();
            if (date('H:i') > '12:40') {
                if (date('N') == '4') {
                    $firstTime = new Carbon($now->addDays(2)->toDateString() . ' 09:00:00');
                } else {
                    $firstTime = new Carbon($now->addDays(1)->toDateString() . ' 09:00:00');
                }
            } else {
                $firstTime = now();
            }

            switch ($time) {
                case 7:
                    {
                        orderSubmit::dispatch($order, 4)->delay($firstTime->addDays(2));
                        orderSubmit::dispatch($order, 5)->delay($firstTime->addDays(5));
                        orderSubmit::dispatch($order, 6)->delay($firstTime->addDays(7));
                    };
                    break;
                case 3:
                    {
                        orderSubmit::dispatch($order, 4)->delay($firstTime->addDays(1));
                        orderSubmit::dispatch($order, 5)->delay($firstTime->addDays(1));
                        orderSubmit::dispatch($order, 6)->delay($firstTime->addDays(1));
                    };
                    break;
                case 1:
                    {
                        orderSubmit::dispatch($order, 4)->delay($firstTime->addHours(8));
                        orderSubmit::dispatch($order, 5)->delay($firstTime->addHours(8));
                        orderSubmit::dispatch($order, 6)->delay($firstTime->addHours(8));
                    };
                    break;
            }
        }
        $parrentOrder = order::find($order->order_id);
        $parrentOrder->delivery_address = $request->address;
        $parrentOrder->save();
        $order->tracking_code = $request->tracking_code;
        $order->save();
        
        $user = User::find($order->user_id);
        if($order->status == 7){
          event(new orderReadyDeliverySMSEvent($user,$order));
        }
      
        return redirect()->back()->withErrors(['عملیات با موفقیت انجام شد'], 'success');
    }

    public function cancelOrder(orderItem $order)
    {
        $profile = profile::find($order->user_id);
        $sum = $order->unit_price * $order->lats * $order->qty;
        $profile->increment('gift_money_bag', $sum);
        $profile->save();
        $log = new moneybagReport();
        $log->user_id = $order->user_id;
        $log->price = $sum;
        $log->type = "admin";
        $log->operation = "increase";
        $log->description = "افزایش اعتبار به دلیل لغو سفارش " . $order->id;
        $log->save();
        $order->delete();
        event(new cancelOrderEvent(User::find($order->user_id), $order));
        return redirect()->back()->withErrors(['سفارش انتخابی با موفقیت کنسل شد'], 'success');
    }


}

?>
