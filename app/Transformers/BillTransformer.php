<?php

namespace App\Transformers;

use App\Models\Bill;
use League\Fractal\TransformerAbstract;

class BillTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['good'];

    public function transform(Bill $bill)
    {
        return [
            'id' => $bill->id,
            'sort' => (int) $bill->sort,
            'num' => (int) $bill->num,
            'good_id' => (int) $bill->good_id,
            'inventory_id' => (int) $bill->inventory_id,
            'receiver_id' => (int) $bill->receiver_id,
            'owner_id' => (int) $bill->owner_id,
            'created_at' => (string) $bill->created_at,
            'updated_at' => (string) $bill->updated_at,
        ];
    }

    public function includeGood(Bill $bill)
    {
        return $this->item($bill->good, new GoodTransformer());
    }
}
