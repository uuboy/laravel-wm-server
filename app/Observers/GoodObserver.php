<?php

namespace App\Observers;
use App\Models\Good;
use App\Notifications\GoodUpdated;
use App\Notifications\GoodDeleted;
use App\Notifications\GoodCreated;
class GoodObserver
{
   public function created(Good $good)
   {
        $good->repository->good_count = $good->repository->goods->count();
        $good->repository->save();
        $good->repository->user->notify(new GoodCreated($good));
   }

   public function deleted(Good $good)
   {
        $good->repository->good_count = $good->repository->goods->count();
        $good->repository->save();
        $good->repository->user->notify(new GoodDeleted($good));
   }

   public function updated(Good $good)
    {
        $good->repository->user->notify(new GoodUpdated($good));
    }
}
