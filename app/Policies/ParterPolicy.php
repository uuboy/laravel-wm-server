<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Parter;

class ParterPolicy extends Policy
{

    public function destroy(User $user, Parter $parter)
    {
        return $user->isAuthorOf($parter->repository) || $user->isAuthorOf($parter);
    }
}
