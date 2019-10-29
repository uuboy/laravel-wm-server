<?php

use Illuminate\Database\Seeder;
use App\Models\Factory;

class FactorysTableSeeder extends Seeder
{
    public function run()
    {
        $factorys = factory(Factory::class)->times(50)->make()->each(function ($factory, $index) {
            if ($index == 0) {
                // $factory->field = 'value';
            }
        });

        Factory::insert($factorys->toArray());
    }

}

