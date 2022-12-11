<?php

namespace App\Observers;

use App\Payment;

class PaymentObserver
{
    /**
     * Handle the payment "created" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function created(Payment $payment)
    {
        $order = $payment->order;
        $order->due = $order->remaining;
        $order->save();
    }

    /**
     * Handle the payment "updated" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function updated(Payment $payment)
    {
        $order = $payment->order;
        $order->due = $order->remaining;
        $order->save();
    }

    /**
     * Handle the payment "deleted" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function deleted(Payment $payment)
    {
        $order = $payment->order;
        $order->due = $order->remaining;
        $order->save();
    }

    /**
     * Handle the payment "restored" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function restored(Payment $payment)
    {
        $order = $payment->order;
        $order->due = $order->remaining;
        $order->save();
    }

    /**
     * Handle the payment "force deleted" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function forceDeleted(Payment $payment)
    {
        $order = $payment->order;
        $order->due = $order->remaining;
        $order->save();
    }
}
