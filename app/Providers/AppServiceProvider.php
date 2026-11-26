<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events\OtpVerificationRequested;
use App\Listeners\SendOtpVerificationEmail;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            OtpVerificationRequested::class,
            SendOtpVerificationEmail::class
        );
    }
}
