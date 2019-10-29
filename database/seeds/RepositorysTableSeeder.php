<?php

use Illuminate\Database\Seeder;
use App\Models\Repository;

class RepositorysTableSeeder extends Seeder
{
    public function run()
    {
        $repositorys = factory(Repository::class)->times(50)->make()->each(function ($repository, $index) {
            if ($index == 0) {
                // $repository->field = 'value';
            }
        });

        Repository::insert($repositorys->toArray());
    }

}

