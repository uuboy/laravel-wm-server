<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use App\Models\Bill;
use App\Observers\BillObserver;
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
        Bill::observe(BillObserver::class);
    }
}
