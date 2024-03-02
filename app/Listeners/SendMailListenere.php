<?php

namespace App\Listeners;

use App\Events\SendMailEvent;
use App\Mail\ContactUsMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailListenere
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendMailEvent $event): void
    {
        Mail::to("ahmed@eraasoft.con")->send(new ContactUsMail($event->data));
    }
}
