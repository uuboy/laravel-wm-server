<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Factory;

class FactoryPolicy extends Policy
{
    public function update(User $user, Factory $factory)
    {
        // return $factory->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Factory $factory)
    {
        return true;
    }
}
