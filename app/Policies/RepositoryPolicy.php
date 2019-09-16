<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Repository;

class RepositoryPolicy extends Policy
{


    public function update(User $user, Repository $repository)
    {
        return $user->isAuthorOf($repository);
    }

    public function destroy(User $user, Repository $repository)
    {
        return $user->isAuthorOf($repository);
    }

    public function show(User $user, Repository $repository)
    {
        return $user->isAuthorOf($repository) || $user->isParterOf($repository);
    }


}
