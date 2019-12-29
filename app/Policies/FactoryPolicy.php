<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Factory;

class FactoryPolicy extends Policy
{

    public function create(User $user, Factory $factory)
    {
        return $user->isAuthorOf($factory->repository) || $user->isParterOf($factory->repository);
    }

    public function update(User $user, Factory $factory)
    {
        return $user->isAuthorOf($factory->repository) || ($user->isParterOf($factory->repository) && $user->isAuthorOf($factory));
    }

    public function destroy(User $user, Factory $factory)
    {
        return $user->isAuthorOf($factory->repository) || ($user->isParterOf($factory->repository) && $user->isAuthorOf($factory));
    }
}
