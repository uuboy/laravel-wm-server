<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Repository;
use App\Models\Good;
use App\Models\Inventory;
use App\Models\Bill;
use App\Models\Factory;
use App\Observers\UserObserver;
use App\Observers\RepositoryObserver;
use App\Observers\GoodObserver;
use App\Observers\InventoryObserver;
use App\Observers\BillObserver;
use App\Observers\FactoryObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \API::error(function  (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException  $exception)  {
                throw new \Symfony\Component\HttpKernel\Exception\HttpException(404,  '404 Not Found');
        });

        \API::error(function (\Illuminate\Auth\Access\AuthorizationException $exception) {
        abort(403, $exception->getMessage());
    });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Repository::observe(RepositoryObserver::class);
        Good::observe(GoodObserver::class);
        Inventory::observe(InventoryObserver::class);
        Bill::observe(BillObserver::class);
        Factory::observe(FactoryObserver::class);
    }
}
