<?php

namespace App\Listeners;

use App\Events\newProductMail;
use App\Mail\ProductMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendProductMail
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
    public function handle(newProductMail $event): void
    {
        Mail::to(auth()->user()->email)->send(new ProductMail($event->product));
    }
}
