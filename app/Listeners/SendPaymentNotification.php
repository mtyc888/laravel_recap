<?php

namespace App\Listeners;

use App\Events\PaymentReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
class SendPaymentNotification implements ShouldQueue //runs on queue
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
    public function handle(PaymentReceived $event): void
    {
        // get the payment object from the recently payment received event
        $payment = $event->payment;
        // get the invoice that the payment is related to
        $invoice = $payment->invoice;
        // get the payer's name
        $clientName = $invoice->client->name;

        Log::info('Payment notification sent', [
            'invoice_number' => $invoice->invoice_number,
            'client' => $clientName,
            'amount' => $payment->amount
        ]);
        /*
        $email = $payment->invoice->user->email
        Mail::to($email)->send(new PaymentReceivedEmail($payment));
        */
    }
}
