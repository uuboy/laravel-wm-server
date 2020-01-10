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

   public function deleting(Good $good)
   {
        foreach ($good->bills as $bill) {
            $bill->inventory->bill_count = $bill->inventory->bill_count - 1;
            $bill->inventory->save();
        }
   }

}
