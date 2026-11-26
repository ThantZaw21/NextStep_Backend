<?php

namespace App\Listeners;

use App\Events\OtpVerificationRequested;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Mail;

class SendOtpVerificationEmail
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
    public function handle(OtpVerificationRequested $event): void
    {
        Mail::to($event->user->email)->send(
            new EmailVerificationMail($event->otp)
        );
    }
}
