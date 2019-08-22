<?php

namespace App\Transformers;

use App\Models\Parter;
use League\Fractal\TransformerAbstract;

class ParterTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['repository','user'];

    public function transform(Parter $parter)
    {
        return [
            'id' => $parter->id,
            'user_id' => (int) $parter->user_id,
            'repository_id' => (int) $parter->repository_id,
            'created_at' => (string) $parter->created_at,
            'updated_at' => (string) $parter->updated_at,
        ];
    }

    public function includeRepository(Parter $parter)
    {
        return $this->item($parter->repository, new RepositoryTransformer());
    }

    public function includeUser(Parter $parter)
    {
        return $this->item($parter->user, new UserTransformer());
    }
}
