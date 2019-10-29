<?php

use Illuminate\Database\Seeder;
use App\Models\Inventory;

class InventorysTableSeeder extends Seeder
{
    public function run()
    {
        $inventorys = factory(Inventory::class)->times(50)->make()->each(function ($inventory, $index) {
            if ($index == 0) {
                // $inventory->field = 'value';
            }
        });

        Inventory::insert($inventorys->toArray());
    }

}

