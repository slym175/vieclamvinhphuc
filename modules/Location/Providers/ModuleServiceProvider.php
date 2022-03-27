<?php

namespace Modules\Location\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(module_path('location', 'Resources/Lang', 'app'), 'location');
        $this->loadViewsFrom(module_path('location', 'Resources/Views', 'app'), 'location');
        $this->loadMigrationsFrom(module_path('location', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('location', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('location', 'Database/Factories', 'app'));
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
