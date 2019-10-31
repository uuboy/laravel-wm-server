<?php

namespace App\Policies;

use App\Models\User;
use App\Models\History;

class HistoryPolicy extends Policy
{
    public function update(User $user, History $history)
    {
        // return $history->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, History $history)
    {
        return true;
    }
}
