<?php

namespace App\Observers;

use App\Models\History;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class HistoryObserver
{
    public function creating(History $history)
    {
        //
    }

    public function updating(History $history)
    {
        //
    }
}