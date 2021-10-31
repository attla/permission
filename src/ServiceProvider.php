<?php

namespace Attla\Permission;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application events
     *
     * @return void
     */
    public function boot()
    {
        // Migrations
        $migrationsPath = __DIR__ . '/../database/migrations';
        $this->publishes([
            $migrationsPath => $this->app->databasePath('migrations'),
        ], 'attla/permission/migrations');

        $this->loadMigrationsFrom($migrationsPath);

        // Seeders
        $this->publishes([
            __DIR__ . '/../stubs/seeds' => $this->app->databasePath('seeders'),
        ], 'attla/permission/seeds');

        //Models
        $this->publishes([
            __DIR__ . '/../stubs/Models' => $this->app->path('Models'),
        ], 'attla/permission/models');

        //Models
        $this->publishes([
            __DIR__ . '/../stubs/Middlewares' => $this->app->path('Http/Middleware'),
        ], 'attla/permission/middlewares');
    }
}
