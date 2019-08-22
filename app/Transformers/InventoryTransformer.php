<?php

namespace App\Transformers;

use App\Models\Inventory;
use League\Fractal\TransformerAbstract;

class InventoryTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['repository'];

    public function transform(Inventory $inventory)
    {
        return [
            'id' => $inventory->id,
            'repository_id' => (int) $inventory->repository_id,
            'mark' => $inventory->mark,
            'created_at' => (string) $inventory->created_at,
            'updated_at' => (string) $inventory->updated_at,
        ];
    }

    public function includeRepository(Inventory $inventory)
    {
        return $this->item($inventory->repository, new GoodTransformer());
    }
}
