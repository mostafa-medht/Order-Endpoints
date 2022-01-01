<?php

namespace App\Listeners;

use App\Services\FirstSMSService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendSmsToSubscriber
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // we can access order from envent varaiable
        // $order->user->mobile;
        FirstSMSService::sendSmsViaNexom('201140805605', "App", 'Order Submitted Succcessfully');
    }
}
