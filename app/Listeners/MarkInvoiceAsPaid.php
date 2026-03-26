<?php

namespace App\Listeners;

use App\Events\PaymentReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
class MarkInvoiceAsPaid
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
     *
     * Everytime a payment is made, we will check if the correlating invoice has been paid off fully or not.
     */
    public function handle(PaymentReceived $event): void
    {
        // we get the invoice that this payment is paying to
        $invoice = $event->payment->invoice;
        // remember, 1 invoice 'hasMany' payments, then we can the sum of total already paid for this invoice
        $totalPaid = $invoice->payments()->sum('amount');
        // if invoice is totally paid off, then we update it's status to paid
        if($totalPaid >= $invoice->total){
            $invoice->update([
                'status' => 'paid',
                'paid_at' => now()
            ]);
            Log::info('Invoice marked as paid', [
                'invoice_id' => $invoice->id,
                'total_paid' => $totalPaid
            ]);
        }
    }
}
