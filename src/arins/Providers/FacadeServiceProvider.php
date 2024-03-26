<?php

namespace Arins\Providers;

use Illuminate\Support\ServiceProvider;

class FacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services and helper.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('response', function ($app) {
            return new \Arins\Helpers\Response\Response();
        });

        $this->app->singleton('formater', function ($app) {
            return new \Arins\Helpers\Formater\Formater();
        });

        $this->app->singleton('convertdate', function ($app) {
            return new \Arins\Helpers\Converter\Date\Convert();
        });

        $this->app->singleton('convertnumber', function ($app) {
            return new \Arins\Helpers\Converter\Number\Convert();
        });

        $this->app->singleton('filex', function ($app) {
            return new \Arins\Helpers\Filex\Filex();
        });

        $this->app->singleton('timeline', function ($app) {
            return new \Arins\Helpers\Timeline\Timeline();
        });

        $this->app->singleton('orderstatus', function ($app) {
            return new \Arins\Helpers\Meetroom\Orderstatus\Orderstatus();
        });
        
    }

    /**
     * Bootstrap services and helper.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
