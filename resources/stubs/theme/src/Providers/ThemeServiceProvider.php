<?php

namespace DummyNamespace\Providers;

use Afbora\LaraThemes\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        parent::boot();

        //
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
