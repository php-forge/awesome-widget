<p align="center">
    <a href="https://github.com/php-forge/awesome-widget" target="_blank">
        <img src="https://avatars.githubusercontent.com/u/103309199?s%253D400%2526u%253Dca3561c692f53ed7eb290d3bb226a2828741606f%2526v%253D4" height="100px">
    </a>
    <a href="https://github.com/php-forge/awesome-widget" target="_blank">
        <img src="https://cdn-icons-png.flaticon.com/512/5762/5762492.png" height="100px">
    </a>    
    <h1 align="center">Foundation Classes and Components for Awesome Widget</h1>
    <br>
</p>

## Requirements

The minimun version of `PHP` required by this package is `PHP 8.1`.

For install this package, you need [composer](https://getcomposer.org/).

## Install

```shell
composer require php-forge/awesome-widget
```

## Usage

[Check the documentation docs](/docs/widget.md) to learn about usage.

## Testing

### Checking dependencies

This package uses [composer-require-checker](https://github.com/maglnet/ComposerRequireChecker) to check if all dependencies are correctly defined in `composer.json`.

To run the checker, execute the following command:

```shell
composer run check-dependencies
```

### Mutation testing

Mutation testing is checked with [Infection](https://infection.github.io/). To run it:

```shell
composer run mutation
```

### Static analysis

The code is statically analyzed with [Psalm](https://psalm.dev/). To run static analysis:

```shell
composer run psalm
```

### Unit tests

The code is tested with [PHPUnit](https://phpunit.de/). To run tests:

```
composer run test
```

## CI status

[![build](https://github.com/php-forge/awesome-widget/actions/workflows/build.yml/badge.svg)](https://github.com/php-forge/awesome-widget/actions/workflows/build.yml)
[![codecov](https://codecov.io/gh/php-forge/awesome-widget/branch/main/graph/badge.svg?token=Hpxye21BHA)](https://codecov.io/gh/php-forge/awesome-widget)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fphp-forge%2Fawesome-widget%2Fmain)](https://dashboard.stryker-mutator.io/reports/github.com/php-forge/awesome-widget/main)
[![static analysis](https://github.com/php-forge/awesome-widget/actions/workflows/static.yml/badge.svg)](https://github.com/php-forge/awesome-widget/actions/workflows/static.yml)
[![type-coverage](https://shepherd.dev/github/php-forge/awesome-widget/coverage.svg)](https://shepherd.dev/github/php-forge/awesome-widget)
[![StyleCI](https://github.styleci.io/repos/597381615/shield?branch=main)](https://github.styleci.io/repos/597381615?branch=main)

## Our social networks

[![Twitter](https://img.shields.io/badge/twitter-follow-1DA1F2?logo=twitter&logoColor=1DA1F2&labelColor=555555?style=flat)](https://twitter.com/Terabytesoftw)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
