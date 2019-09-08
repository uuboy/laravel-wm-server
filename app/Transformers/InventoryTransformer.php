<?php

namespace App\Transformers;

use App\Models\Inventory;
use League\Fractal\TransformerAbstract;

class InventoryTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['repository','lastUpdater'];

    public function transform(Inventory $inventory)
    {
        return [
            'id' => $inventory->id,
            'sort' => (int) $inventory->sort,
            'name' => $inventory->name,
            'bill_count' => $inventory->bill_count,
            'repository_id' => (int) $inventory->repository_id,
            'receiver_id' => (int) $inventory->receiver_id,
            'owner_id' => (int) $inventory->owner_id,
            'last_updater_id' => (int) $inventory->last_updater_id,
            'created_at' => (string) $inventory->created_at,
            'updated_at' => (string) $inventory->updated_at,
        ];
    }

    public function includeRepository(Inventory $inventory)
    {
        return $this->item($inventory->repository, new GoodTransformer());
    }

     public function includeLastUpdater(Inventory $inventory)
     {
        return $this->item($inventory->lastUpdater, new UserTransformer());
     }
}
