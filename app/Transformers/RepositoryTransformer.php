<?php

namespace App\Transformers;

use App\Models\Repository;
use League\Fractal\TransformerAbstract;

class RepositoryTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user'];

    public function transform(Repository $repository)
    {
        return [
            'id' => $repository->id,
            'name' => $repository->name,
            'user_id' => (int) $repository->user_id,
            'created_at' => (string) $repository->created_at,
            'updated_at' => (string) $repository->updated_at,
        ];
    }

    public function includeUser(Repository $repository)
    {
        return $this->item($repository->user, new UserTransformer());
    }
}
