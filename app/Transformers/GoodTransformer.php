<?php

namespace App\Transformers;

use App\Models\Good;
use League\Fractal\TransformerAbstract;

class GoodTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['repository'];

    public function transform(Good $good)
    {
        return [
            'id' => $good->id,
            'name' => $good->name,
            'type' => $good->type,
            'sort' => (int) $good->sort,
            'factory' => $good->factory,
            'price' => (double) $good->price,
            'num' => (int) $good->num,
            'unit' => $good->unit,
            'repository_id' => (int) $good->repository_id,
            'created_at' => (string) $good->created_at,
            'updated_at' => (string) $good->updated_at,
        ];
    }

    public function includeRepository(Good $good)
    {
        return $this->item($good->repository, new RepositoryTransformer());
    }
}
