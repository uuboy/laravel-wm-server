<?php

namespace App\Transformers;

use App\Models\Factory;
use League\Fractal\TransformerAbstract;

class FactoryTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['inventory'];

    public function transform(Factory $factory)
    {
        return [
            'id' => $factory->id,
            'name' => $factory->name,
            'code' => $factory->code,
            'tel' => $factory->tel,
            'bank' => $factory->bank,
            'account' => $factory->account,
            'address' => $factory->address,
            'repository_id' => (int) $factory->repository_id,
            'created_at' => (string) $factory->created_at,
            'updated_at' => (string) $factory->updated_at,
        ];
    }

    public function includeInventory(Factory $factory)
    {
        return $this->item($factory->inventory, new InventoryTransformer());
    }

}
