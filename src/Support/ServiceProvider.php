<?php

namespace Afbora\LaraThemes\Support;

use Afbora\LaraThemes\Facades\Theme;
use Afbora\LaraThemes\Concerns\GetsManifest;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    use GetsManifest;

    public function boot()
    {
        $slug = $this->getManifest()['slug'];

        if(Theme::getCurrent() === $slug) {
            $this->loadTranslationsFrom(Theme::path('resources/lang'), 'theme');
            $this->loadViewsFrom(Theme::path('resources/views'), 'theme');
        }
    }
}
