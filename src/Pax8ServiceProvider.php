<?php

namespace Mvdgeijn\Pax8;

use Illuminate\Support\ServiceProvider;

class Pax8ServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/pax8.php', 'pax8'
        );    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/pax8.php' => config_path('pax8.php'),
        ]);    }
}
