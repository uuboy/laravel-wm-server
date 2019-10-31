<?php

use Illuminate\Database\Seeder;
use App\Models\History;

class HistorysTableSeeder extends Seeder
{
    public function run()
    {
        $historys = factory(History::class)->times(50)->make()->each(function ($history, $index) {
            if ($index == 0) {
                // $history->field = 'value';
            }
        });

        History::insert($historys->toArray());
    }

}

