<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Bill;

class BillPolicy extends Policy
{
    public function update(User $user, Bill $bill)
    {
        return $user->isAuthorOf($bill->good->repository) || $user->isParterOf($bill->good->repository);
    }

    public function destroy(User $user, Bill $bill)
    {
        return $user->isAuthorOf($bill->good->repository) || $user->isParterOf($bill->good->repository);
    }

    public function show(User $user, Bill $bill)
    {
        return $user->isAuthorOf($bill->good->repository) || $user->isParterOf($bill->good->repository);
    }
}
