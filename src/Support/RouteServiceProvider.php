<?php

namespace Afbora\LaraThemes\Support;

use Afbora\LaraThemes\Concerns\GetsManifest;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as LaravelRouteServiceProvider;

class RouteServiceProvider extends LaravelRouteServiceProvider
{
    use GetsManifest;
}
