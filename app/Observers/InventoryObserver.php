<?php

namespace App\Observers;
use App\Models\Inventory;

class InventoryObserver
{
    public function created(Inventory $inventory)
    {
        $inventory->repository->inventory_count = $inventory->repository->inventories->count();
        $inventory->repository->save();
    }

    public function deleted(Inventory $inventory)
    {
        $inventory->repository->inventory_count = $inventory->repository->inventories->count();
        $inventory->repository->save();
        $bills = $inventory->bills()->get();
        if($inventory->sort == 0){
            foreach ($bills as $bill) {
                $bill->good->num += $bill->num;
                $bill->good->save();
            }
        }

        if($inventory->sort == 1){
            foreach ($bills as $bill) {
                $bill->good->num -= $bill->num;
                $bill->good->save();
            }
        }

        $inventory->bills()->delete();


    }

    public function restored(Inventory $inventory)
    {
        $inventory->repository->inventory_count = $inventory->repository->inventories->count();
        $inventory->repository->save();
        $inventory->bills()->restore();
        $bills = $inventory->bills()->get();
        if($inventory->sort == 1){
            foreach ($bills as $bill) {
                $bill->good->num += $bill->num;
                $bill->good->save();
            }
        }
        if($inventory->sort == 0){
            foreach ($bills as $bill) {
                $bill->good->num -= $bill->num;
                $bill->good->save();
            }
        }

    }

    public function forceDeleted(Inventory $inventory)
    {
        $inventory->repository->inventory_count = $inventory->repository->inventories->count();
        $inventory->repository->save();
        $inventory->bills()->withTrashed()->forceDelete();
    }


}
