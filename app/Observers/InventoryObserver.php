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

    }

    public function forceDeleted(Inventory $inventory)
    {
        $inventory->repository->inventory_count = $inventory->repository->inventories->count();
        $inventory->repository->save();

    }

    public function restored(Inventory $inventory)
    {
        $inventory->repository->inventory_count = $inventory->repository->inventories->count();
        $inventory->repository->save();

    }

}
