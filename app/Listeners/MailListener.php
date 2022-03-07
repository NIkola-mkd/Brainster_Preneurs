<?php

namespace App\Listeners;

use App\Events\MailEvent;
use App\Mail\ApplicantMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use PharIo\Manifest\ApplicationName;

class MailListener
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
    public function handle(MailEvent $event)
    {
        Mail::to($event->email)->send(new ApplicantMail($event->name, $event->title, $event->skills, $event->msg));
    }
}
