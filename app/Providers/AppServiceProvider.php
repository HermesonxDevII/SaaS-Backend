<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\{ Blade };

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::anonymousComponentPath(resource_path('views/registrations/components'), 'registration');
        Blade::anonymousComponentPath(resource_path('views/companies/components'), 'company');
        Blade::anonymousComponentPath(resource_path('views/company-groups/components'), 'company-group');
        Blade::anonymousComponentPath(resource_path('views/company-segments/components'), 'company-segment');
        Blade::anonymousComponentPath(resource_path('views/responsible-teams/components'), 'responsible-team');
    }
}
