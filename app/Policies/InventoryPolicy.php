<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Inventory;

class InventoryPolicy extends Policy
{
     public function create(User $user, Inventory $inventory)
    {
        return $user->isAuthorOf($inventory->repository) || $user->isParterOf($inventory->repository);
    }

     public function update(User $user, Inventory $inventory)
    {
        return $user->isAuthorOf($inventory->repository) || $user->isParterOf($inventory->repository);
    }

    public function destroy(User $user, Inventory $inventory)
    {
        return $user->isAuthorOf($inventory->repository) || $user->isParterOf($inventory->repository);
    }

    public function show(User $user, Inventory $inventory)
    {
        return $user->isAuthorOf($inventory->repository) || $user->isParterOf($inventory->repository);
    }
}
