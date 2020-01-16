<?php

namespace App\Observers;

use App\Models\Bill;


class BillObserver
{
    /**
     * Handle the bill "created" event.
     *
     * @param  \App\Bill  $bill
     * @return void
     */
    public function created(Bill $bill)
    {
        $bill->inventory->bill_count = $bill->inventory->bills->count();
        $bill->inventory->save();

    }

    /**
     * Handle the bill "updated" event.
     *
     * @param  \App\Bill  $bill
     * @return void
     */
    public function updated(Bill $bill)
    {


    }

    /**
     * Handle the bill "deleted" event.
     *
     * @param  \App\Bill  $bill
     * @return void
     */
    public function deleted(Bill $bill)
    {
        $bill->inventory->bill_count = $bill->inventory->bills->count();
        $bill->inventory->save();

    }

    /**
     * Handle the bill "restored" event.
     *
     * @param  \App\Bill  $bill
     * @return void
     */
    public function restored(Bill $bill)
    {
        $bill->inventory->bill_count = $bill->inventory->bills->count();
        $bill->inventory->save();
    }

    /**
     * Handle the bill "force deleted" event.
     *
     * @param  \App\Bill  $bill
     * @return void
     */
    public function forceDeleted(Bill $bill)
    {
        $bill->inventory->bill_count = $bill->inventory->bills->count();
        $bill->inventory->save();
    }
}
