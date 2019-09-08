<?php

namespace App\Transformers;

use App\Models\Repository;
use League\Fractal\TransformerAbstract;

class RepositoryTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user','lastUpdater'];

    public function transform(Repository $repository)
    {
        return [
            'id' => $repository->id,
            'name' => $repository->name,
            'inventory_count' => (int) $repository->inventory_count,
            'good_count' => (int) $repository->good_count,
            'user_id' => (int) $repository->user_id,
            'last_updater_id' => (int) $repository->last_updater_id,
            'created_at' => (string) $repository->created_at,
            'updated_at' => (string) $repository->updated_at,
        ];
    }

    public function includeUser(Repository $repository)
    {
        return $this->item($repository->user, new UserTransformer());
    }

    public function includeLastUpdater(Repository $repository)
    {
        return $this->item($repository->lastUpdater, new UserTransformer());
    }
}
