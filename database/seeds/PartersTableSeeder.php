<?php

use Illuminate\Database\Seeder;
use App\Models\Parter;

class PartersTableSeeder extends Seeder
{
    public function run()
    {
        $parters = factory(Parter::class)->times(50)->make()->each(function ($parter, $index) {
            if ($index == 0) {
                // $parter->field = 'value';
            }
        });

        Parter::insert($parters->toArray());
    }

}

