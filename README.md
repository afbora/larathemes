# Laravel Themes
[![Source](https://img.shields.io/badge/source-afbora/larathemes-blue?style=flat-square)](https://github.com/afbora/larathemes)
[![Download](https://img.shields.io/packagist/dt/afbora/larathemes?style=flat-square)](https://github.com/afbora/larathemes)
[![Open Issues](https://img.shields.io/github/issues-raw/afbora/larathemes?style=flat-square)](https://github.com/afbora/larathemes)
[![Last Commit](https://img.shields.io/github/last-commit/afbora/larathemes?style=flat-square)](https://github.com/afbora/larathemes)
[![Release](https://img.shields.io/github/v/release/afbora/larathemes?style=flat-square)](https://github.com/afbora/larathemes)
[![License](https://img.shields.io/github/license/afbora/larathemes?style=flat-square)](https://github.com/afbora/larathemes)

Themes gives the means to group together a set of views and assets for Laravel. This gives an easy way to further decouple the way your web application looks from your code base.

## Installation
Simply install the package through Composer. From here the package will automatically register its service provider and `Theme` facade.

```
composer require afbora/larathemes
```

## Config
To publish the config file, run the following:

```
php artisan vendor:publish --provider="Afbora\LaraThemes\ThemesServiceProvider" --tag="config"
```

## Changelog
You will find a complete changelog history within the [CHANGELOG](CHANGELOG.md) file.

## Credits
- [Ahmet Bora](https://github.com/afbora)
- [Shea Lewis](https://github.com/kaidesu)
- [All Contributors](../../contributors)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
