<?php

namespace App\Observers;
use App\Models\Good;

class GoodObserver
{
   public function created(Good $good)
   {
        $good->repository->good_count = $good->repository->goods->count();
        $good->repository->save();

   }

   public function deleted(Good $good)
   {
        $good->repository->good_count = $good->repository->goods->count();
        $good->repository->save();
   }

   public function forceDeleted(Good $good)
   {
        $good->repository->good_count = $good->repository->goods->count();
        $good->repository->save();
   }

   public function restored(Good $good)
   {
        $good->repository->good_count = $good->repository->goods->count();
        $good->repository->save();
   }

}
