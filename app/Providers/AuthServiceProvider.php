<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
		 \App\Models\History::class => \App\Policies\HistoryPolicy::class,
		 \App\Models\Factory::class => \App\Policies\FactoryPolicy::class,
        'App\Models\Repository' => 'App\Policies\RepositoryPolicy',
        'App\Models\Good' => 'App\Policies\GoodPolicy',
        'App\Models\Inventory' => 'App\Policies\InventoryPolicy',
        'App\Models\Bill' => 'App\Policies\BillPolicy',
        'App\Models\Parter' => 'App\Policies\ParterPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
