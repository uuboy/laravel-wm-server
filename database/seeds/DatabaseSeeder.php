<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
		// $this->call(HistorysTableSeeder::class);
		// $this->call(PartersTableSeeder::class);
		// $this->call(FactorysTableSeeder::class);
		// $this->call(BillsTableSeeder::class);
		// $this->call(GoodsTableSeeder::class);
		// $this->call(InventorysTableSeeder::class);
		// $this->call(RepositorysTableSeeder::class);
    }
}
