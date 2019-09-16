<?php

namespace App\Transformers;

use App\Models\Bill;
use League\Fractal\TransformerAbstract;

class BillTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['good','inventory','lastUpdater'];

    public function transform(Bill $bill)
    {
        return [
            'id' => $bill->id,
            'num' => (int) $bill->num,
            'good_id' => (int) $bill->good_id,
            'inventory_id' => (int) $bill->inventory_id,
            'last_updater_id' => (int) $bill->last_updater_id,
            'created_at' => (string) $bill->created_at,
            'updated_at' => (string) $bill->updated_at,
        ];
    }

    public function includeGood(Bill $bill)
    {
        return $this->item($bill->good, new GoodTransformer());
    }

    public function includeInventory(Bill $bill)
    {
        return $this->item($bill->inventory, new InventoryTransformer());
    }

    public function includeLastUpdater(Bill $bill)
    {
        return $this->item($bill->lastUpdater, new UserTansfromer());
    }
}
