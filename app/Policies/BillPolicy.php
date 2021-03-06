<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Bill;

class BillPolicy extends Policy
{

    public function create(User $user, Bill $bill)
    {
        return $user->isAuthorOf($bill->good->repository) || $user->isParterOf($bill->good->repository);
    }

    public function update(User $user, Bill $bill)
    {
        return $user->isAuthorOf($bill->good->repository) || ($user->isParterOf($bill->good->repository) && $user->isAuthorOf($bill));
    }

    public function destroy(User $user, Bill $bill)
    {
        return $user->isAuthorOf($bill->good->repository) || ($user->isParterOf($bill->good->repository) && $user->isAuthorOf($bill));
    }

    public function restore(User $user, Bill $bill)
    {
        return $user->isAuthorOf($bill->good->repository) || ($user->isParterOf($bill->good->repository) && $user->isAuthorOf($bill));
    }

}
