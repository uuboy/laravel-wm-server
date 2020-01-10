<?php

namespace App\Transformers;

use App\Models\Factory;
use League\Fractal\TransformerAbstract;

class FactoryTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['inventory','lastUpdater','user'];

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
            'user_id' => (int) $factory->user_id,
            'last_updater_id' => (int) $factory->last_updater_id,
            'created_at' => (string) $factory->created_at,
            'updated_at' => (string) $factory->updated_at,
        ];
    }

    public function includeInventory(Factory $factory)
    {
        return $this->item($factory->inventory, new InventoryTransformer());
    }

    public function includeLastUpdater(Factory $factory)
    {
        return $this->item($factory->lastUpdater, new UserTransformer());
    }

    public function includeUser(Factory $factory)
    {
        return $this->item($factory->user, new UserTransformer());
    }

}
