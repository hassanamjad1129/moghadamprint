<?php

namespace App\Providers;

use App\orderItem;
use App\User;
use App\notification;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\option;
use App\deliverie;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('admin.layouts.master', function ($view) {
            $notVerifiedCustomers = User::where('active', 0)->count();
            $countDeliveries = deliverie::all()->where('status',0)->count();
            $view->with([
                'usersNotifications'=>notification::where('category','register')->where('seen',0)->orderBy('id','desc')->get(),
                'orderNotifications'=>notification::where('category','order')->where('seen',0)->orderBy('id','desc')->get(),
                'ticketNotifications'=>notification::where('category','ticket')->where('seen',0)->orderBy('id','desc')->get(),
                'notVerifiedCustomers' => $notVerifiedCustomers,
                 'countDeliveries' => $countDeliveries,
            ]);
        });

        view()->composer('layouts.app', function ($view) {
            $priceList=option::find('priceList')->option_value;
            $linkInstagram = option::where('option_name','instagram')->first()->option_value;
            $linkTelegram = option::where('option_name','telegram')->first()->option_value;
            $view->with([
                'priceList' => $priceList,
                'linkInstagram' => $linkInstagram,
                'linkTelegram' => $linkTelegram
            ]);
        });
        view()->composer('customer.layouts.master', function ($view) {
            $cart = orderItem::where('verified', 0)->where('user_id', auth()->user()->id)->count();
            $linkInstagram = option::where('option_name','instagram')->first()->option_value;
            $linkTelegram = option::where('option_name','telegram')->first()->option_value;
            $view->with([
                'cart' => $cart,
                'linkInstagram' => $linkInstagram,
                'linkTelegram' => $linkTelegram
            ]);
        });
    
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
