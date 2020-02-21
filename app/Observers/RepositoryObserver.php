<?php

namespace App\Observers;
use App\Models\Repository;
class RepositoryObserver
{
    public function created(Repository $repository)
    {
        $repository->user->repository_count = $repository->user->repositories->count();
        $repository->user->save();

    }

    public function deleted(Repository $repository)
    {
        $repository->user->repository_count = $repository->user->repositories->count();
        $repository->user->save();

    }

    public function forceDeleted(Repository $repository)
    {
        $repository->user->repository_count = $repository->user->repositories->count();
        $repository->user->save();
        $repository->goods()->withTrashed()->forceDelete();
        $repository->factories()->withTrashed()->forceDelete();
        $repository->parters()->withTrashed()->forceDelete();
        $inventories = $repository->inventories()->withTrashed()->get();
        foreach ($inventories as $inventory) {
            $inventory->bills()->withTrashed()->forceDelete();
        }
        $repository->inventories()->withTrashed()->forceDelete();

    }
     public function restored(Repository $repository)
    {
        $repository->user->repository_count = $repository->user->repositories->count();
        $repository->user->save();

    }

}
