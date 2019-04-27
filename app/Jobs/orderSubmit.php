<?php

namespace App\Jobs;

use App\order;
use App\orderItem;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class orderSubmit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $order;
    protected $type;

    /**
     * orderSubmit constructor.
     * @param orderItem $order
     * @param int $type
     */
    public function __construct(orderItem $order, int $type)
    {
        $this->order = $order;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->order->status>6){
          return;
        }
        $order=orderItem::find($this->order->id);
        $order->status = $this->type;
        $order->save();
    }
}
