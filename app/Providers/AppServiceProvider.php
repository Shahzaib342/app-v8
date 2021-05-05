<?php

namespace App\Providers;

use App\Services\BindingPrimitives;
use App\Services\ContextualPusher;
use App\Services\Decorator;
use App\Services\EventPusher;
use App\Services\Foo;
use App\Services\Messenger;
use App\Services\RedisEventPusher;
use App\Services\SlackMessenger;
use App\Services\TwillioMessenger;
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

        //binding primitives - inject primitive value
//        $this->app->when(BindingPremitives::class)
//            ->needs('$var')
//            ->give(2);

        //binding primitives - inject container binding with tag
        $this->app->when(BindingPrimitives::class)
            ->needs('$var')
            ->giveTagged('var');

        //service container - tagging
        $this->app->bind(SlackMessenger::class, function () {
            return new SlackMessenger();
        });

        $this->app->bind(TwillioMessenger::class, function () {
            return new TwillioMessenger();
        });

        $this->app->tag([SlackMessenger::class, TwillioMessenger::class], Messenger::class);

        $this->app->bind(Messenger::class, function ($app) {
            return new SlackMessenger($app->tagged(Messenger::class));
        });

        //extending already a resolved service
//        $this->app->extend(TwillioMessenger::class, function ($service, $app) {
//            return new Decorator($service);
//        });
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
