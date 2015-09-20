<?php

namespace Gemini\Providers;

use Illuminate\Support\ServiceProvider;

class AMQPServiceProvider extends ServiceProvider
{

    protected $defer = TRUE;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('amqp', function ($app) {
            $config = $app['config']['database']['amqp'];
            $connection = new \AMQPConnection($config);
            $connection->connect();
            return $connection;
        });
    }
}
