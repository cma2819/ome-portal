<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('access-to-admin', 'App\Policies\DomainPermissionPolicy@hasPermissionToAdmin');
        Gate::define('access-to-twitter', 'App\Policies\DomainPermissionPolicy@hasPermissionToTwitter');
        Gate::define('access-to-internal-stream', 'App\Policies\DomainPermissionPolicy@hasPermissionToInternalStream');
    }
}
