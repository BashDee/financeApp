<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Need;
use App\Policies\NeedPolicy;
use App\Models\Want;
use App\Policies\WantPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }

    protected function registerPolicies()
    {
        $this->app->bind(Need::class, NeedPolicy::class);
        $this->app->bind(Want::class, WantPolicy::class);
    }
} 