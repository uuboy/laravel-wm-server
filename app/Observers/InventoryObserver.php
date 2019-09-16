<?php

namespace App\Observers;
use App\Models\Inventory;
use App\Notifications\InventoryUpdated;
use App\Notifications\InventoryDeleted;
use App\Notifications\InventoryCreated;

class InventoryObserver
{
    public function created(Inventory $inventory)
    {
        $inventory->repository->inventory_count = $inventory->repository->inventories->count();
        $inventory->repository->save();
        $inventory->repository->user->notify(new InventoryCreated($inventory));
    }

    public function deleted(Inventory $inventory)
    {
        $inventory->repository->inventory_count = $inventory->repository->inventories->count();
        $inventory->repository->save();
        $inventory->repository->user->notify(new InventoryDeleted($inventory));
    }

    public function updated(Inventory $inventory)
    {
        $inventory->repository->user->notify(new InventoryUpdated($inventory));
    }
}
