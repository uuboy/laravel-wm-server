<?php

namespace App\Observers;

use App\Models\Factory;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class FactoryObserver
{
    public function creating(Factory $factory)
    {
        //
    }

    public function updating(Factory $factory)
    {
        //
    }

    public function deleting(Factory $factory)
    {
        foreach ($factory->inventories as $inventory) {
            $inventory->repository->inventory_count = $inventory->repository->inventory_count - 1;
            $inventory->repository->save();
        }
    }
}
