<?php

namespace HadyFayed\LaravelInstaller\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use HadyFayed\LaravelInstaller\Middleware\CanInstall;
use HadyFayed\LaravelInstaller\Middleware\CanUpdate;

class LaravelInstallerServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap the application events.
     *
     * @param $void
     */
    public function boot(Router $router)
    {
        $this->publishes([__DIR__.'/../../config/installer.php' => config_path('installer.php'),]
            , 'laravelinstaller');

        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        $router->middlewareGroup('install',[CanInstall::class]);
        $router->middlewareGroup('update',[CanUpdate::class]);

        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'installer');
        $this->publishes([__DIR__.'/../../resources/lang' => resource_path('lang/vendor/installer'),]
            , 'laravelinstaller');

        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'installer');
        $this->publishes([__DIR__.'/../../resources/views' => resource_path('views/vendor/installer'),]
            , 'laravelinstaller');

        $this->publishes([__DIR__.'/../../resources/assets' => public_path('vendor/installer'),], 'laravelinstaller');
    }
}
