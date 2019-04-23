<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        'App\Events\registerSMSEvent' => [
            'App\Listeners\registerSMSListener'
        ],
        'App\Events\adminRegisterSMSEvent' => [
            'App\Listeners\adminRegisterSMSListener'
        ],
        'App\Events\verifyUserEvent' => [
            'App\Listeners\verifyUserListener'
        ],
        'App\Events\verifyOrderEvent' => [
            'App\Listeners\verifyOrderListener'
        ],
        'App\Events\cancelOrderEvent' => [
            'App\Listeners\cancelOrderListener'
        ],
        'App\Events\sendMoneyBagSmsEvent' => [
            'App\Listeners\sendMoneyBagSmsListener'
        ],
        'App\Events\finishedOrderEvent' => [
            'App\Listeners\finishedOrderListener'
        ],
        'App\Events\deliveredOrderEvent' => [
            'App\Listeners\deliveredOrderListener'
        ],
        'App\Events\stoppedOrderEvent' => [
            'App\Listeners\stoppedOrderListener'
        ],
      'App\Events\orderReadyDeliverySMSEvent' => [
          'App\Listeners\orderReadyDeliverySMSListener'
      ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
