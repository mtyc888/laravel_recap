<?php

namespace App\Providers;

use App\Events\PaymentReceived;
use App\Listeners\SendPaymentNotification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Listeners\MarkInvoiceAsPaid;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * This is for binding things into the service container, "When someone ask for X give them Y"
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * Register your events and it's listeners here, "when event X happens, call listeners Y"
     */
    public function boot(): void
    {
        Event::listen(PaymentReceived::class, MarkInvoiceAsPaid::class);
        Event::listen(PaymentReceived::class, SendPaymentNotification::class);
    }
}
