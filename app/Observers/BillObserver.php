<?php

namespace App\Observers;

use App\Models\Bill;


class BillObserver
{
    /**
     * Handle the bill "created" event.
     *
     * @param  \App\Models\Bill  $bill
     * @return void
     */
    public function created(Bill $bill)
    {
        $bill->inventory->bill_count = $bill->inventory->bills->count();
        $bill->inventory->save();

        if($bill->inventory->sort == 0){
            $bill->good->num -= $bill->num;
            $bill->good->save();
        }
        if($bill->inventory->sort == 1) {
            $bill->good->num += $bill->num;
            $bill->good->save();
        }

    }

    /**
     * Handle the bill "updated" event.
     *
     * @param  \App\Models\Bill  $bill
     * @return void
     */

    public function updating(Bill $bill)
    {
        $bill2 = Bill::withTrashed()->where('id',$bill->id)->first();
        if($bill->inventory->sort == 0){
            $bill->good->num += $bill2->num;
            $bill->good->save();
        }
        if($bill->inventory->sort == 1){
            $bill->good->num -= $bill2->num;
            $bill->good->save();
        }
    }
    public function updated(Bill $bill)
    {
        if($bill->inventory->sort == 1){
            $bill->good->num += $bill->num;
            $bill->good->save();
        }
        if($bill->inventory->sort == 0){
            $bill->good->num -= $bill->num;
            $bill->good->save();
        }
    }

    /**
     * Handle the bill "deleted" event.
     *
     * @param  \App\Models\Bill  $bill
     * @return void
     */
    public function deleted(Bill $bill)
    {
        $bill->inventory->bill_count = $bill->inventory->bills->count();
        $bill->inventory->save();
        if($bill->inventory->sort == 0){
            $bill->good->num += $bill->num;
            $bill->good->save();
        }
        if($bill->inventory->sort == 1) {
            $bill->good->num -= $bill->num;
            $bill->good->save();
        }

    }

    /**
     * Handle the bill "restored" event.
     *
     * @param  \App\Models\Bill  $bill
     * @return void
     */
    public function restored(Bill $bill)
    {

        if($bill->inventory->sort == 1){
            $bill->good->num += $bill->num;
            $bill->good->save();
        }
        if($bill->inventory->sort == 0) {
            $bill->good->num -= $bill->num;
            $bill->good->save();
        }
        $bill->inventory->bill_count = $bill->inventory->bills->count();
        $bill->inventory->save();
    }

    /**
     * Handle the bill "force deleted" event.
     *
     * @param  \App\Models\Bill  $bill
     * @return void
     */
    public function forceDeleted(Bill $bill)
    {
        if($bill->inventory->sort == 1){
            $bill->good->num += $bill->num;
            $bill->good->save();
        }
        if($bill->inventory->sort == 0) {
            $bill->good->num -= $bill->num;
            $bill->good->save();
        }
    }
}
