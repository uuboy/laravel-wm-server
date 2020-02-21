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
		 \App\Models\Factory::class => \App\Policies\FactoryPolicy::class,
        \App\Models\Repository::class => \App\Policies\RepositoryPolicy::class,
        \App\Models\Good::class => \App\Policies\GoodPolicy::class,
        \App\Models\Inventory::class => \App\Policies\InventoryPolicy::class,
        \App\Models\Bill::class => \App\Policies\BillPolicy::class,
        \App\Models\Parter::class => \App\Policies\ParterPolicy::class,
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
