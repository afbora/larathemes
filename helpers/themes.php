<?php

if (!function_exists('theme_path')) {
    /**
     * Return the path to the given theme file.
     *
     * @param string|null $file
     * @param string|null $theme
     * @return string|null
     */
    function theme_path(string $file = null, string $theme = null): ?string
    {
        return Theme::path($file, $theme);
    }
}

if (!function_exists('theme_asset')) {
    /**
     * Return the asset url to the given theme file.
     *
     * @param string $file
     * @param string|null $theme
     * @return string|null
     * @author Ahmet Bora
     */
    function theme_asset(string $file, string $theme = null): ?string
    {
        $theme = $theme ?? Theme::getCurrent();

        if (empty($theme) === false) {
            return asset('Themes/' . $theme . '/' . $file);
        }

        return null;
    }
}
