<?php

namespace App\Observers;
use App\Models\Repository;
use App\Notifications\RepositoryUpdate;
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

    public function updated(Repository $repository)
    {
        $repository->user->notify(new RepositoryUpdate($repository));
    }
}
