<?php

namespace App\Providers;

use App\Services\ContextualPusher;
use App\Services\EventPusher;
use App\Services\Foo;
use App\Services\RedisEventPusher;
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
        //you can use bind or singleton(if object only needs to be instantiated once)
        $this->app->singleton(Foo::class, function ($app) {
            // Pass the application name
            return new Foo($app->config['app.name']);
        });

        //binding interface to implementation
        $this->app->bind(EventPusher::class, function () {
            return new RedisEventPusher();
        });

        //contextual bindings
        $this->app->when(RedisEventPusher::class)
            ->needs(EventPusher::class)
            ->give(function () {
                return new RedisEventPusher();
            });

        $this->app->when(ContextualPusher::class)
            ->needs(EventPusher::class)
            ->give(function () {
                return new ContextualPusher();
            });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
