<?php

namespace Afbora\LaraThemes;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Afbora\LaraThemes\Concerns\RegistersViewLocations;

class Theme extends Collection
{
    use RegistersViewLocations;

    /**
     * @var string|null
     */
    protected $current;

    /**
     * @var string|null
     */
    protected $layout;

    /**
     * Register and set the currently active theme.
     *
     * @param string $theme
     * @return self
     */
    public function set(string $theme): self
    {
        list($theme, $parent) = $this->resolveTheme($theme);

        if (!$this->isCurrently($theme->get('slug')) and (!is_null($this->getCurrent()))) {
            $this->removeRegisteredLocation();
        }

        $this->setCurrent($theme->get('slug'));

        $this->registerAutoload($this->format($theme->get('slug')));
        $this->addRegisteredLocation($theme, $parent);
        $this->symlinkPublicDirectory();
        $this->registerServiceProvider($this->format($theme->get('slug')));

        return $this;
    }

    /**
     * Get the path of the given theme file.
     *
     * @param string|null $file
     * @param string|null $theme
     * @return string|null
     */
    public function path(string $file = null, string $theme = null): ?string
    {
        if (empty($theme) === true) {
            $theme = $this->getCurrent();
        }

        if (empty($theme) === false) {
            $theme = $this->format($theme);

            return base_path('Themes/' . $theme . (empty($file) === false ? '/' . $file : null));
        }

        return null;
    }

    /**
     * Get the layout property.
     *
     * @return string|null
     */
    public function getLayout(): ?string
    {
        return $this->layout;
    }

    /**
     * Set the layout property.
     *
     * @param string $layout
     * @return self
     */
    public function setLayout(string $layout): self
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * Set the current theme property.
     *
     * @param string $theme
     */
    public function setCurrent(string $theme): self
    {
        $this->current = $theme;

        return $this;
    }

    /**
     * Get the current theme property.
     *
     * @return string
     */
    public function getCurrent(): ?string
    {
        return $this->current;
    }

    /**
     * Determine if the given theme is the currently set theme.
     *
     * @param string $theme
     * @return bool
     */
    public function isCurrently(string $theme): bool
    {
        return $this->current === $theme;
    }

    /**
     * Format the given name as the directory basename.
     *
     * @param string $name
     * @return string
     */
    protected function format(string $name): string
    {
        return ucfirst(Str::camel($name));
    }

    /**
     * Symlink the themes public directory so its accessible
     * by the web.
     *
     * @return void
     */
    protected function symlinkPublicDirectory(): void
    {
        $theme = $this->format($this->getCurrent());

        if (!file_exists(public_path('Themes/' . $theme))) {
            if (!file_exists(public_path('Themes'))) {
                app()->make('files')->makeDirectory(public_path('Themes'));
            }

            app()->make('files')->link(
                $this->path('public'), public_path('Themes/' . $theme)
            );
        }
    }

    /**
     * Register the theme's service provider.
     *
     * @param string $theme
     * @return void
     */
    protected function registerServiceProvider(string $theme): void
    {
        app()->register("Themes\\$theme\\Providers\\ThemeServiceProvider");
    }

    /**
     * Register the themes path as a PSR-4 reference.
     *
     * @param string $theme
     * @return void
     */
    protected function registerAutoload(string $theme): void
    {
        $base = 'Themes\\' . $theme . '\\';
        $path = $this->path('src/');

        spl_autoload_register(function ($class) use ($base, $path) {
            $file = str_replace($base, '', $class);
            $file = str_replace('\\', '/', $file);
            $file = $file . '.php';

            if (file_exists($path . $file)) {
                include($path . $file);
            }
        });
    }
}
