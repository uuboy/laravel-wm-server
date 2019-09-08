<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Good;

class GoodPolicy extends Policy
{
    public function update(User $user, Good $good)
    {
        return $user->isAuthorOf($good->repository) || $user->isParterOf($good->repository);
    }

    public function destroy(User $user, Good $good)
    {
        return $user->isAuthorOf($good->repository) || $user->isParterOf($good->repository);
    }

    public function show(User $user, Good $good)
    {
        return $user->isAuthorOf($good->repository) || $user->isParterOf($good->repository);
    }
}
