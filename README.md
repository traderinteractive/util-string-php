# util-string-php

[![Build Status](https://travis-ci.org/traderinteractive/util-string-php.svg?branch=master)](https://travis-ci.org/traderinteractive/util-string-php)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/traderinteractive/util-string-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/traderinteractive/util-string-php/?branch=master)
[![Coverage Status](https://coveralls.io/repos/github/traderinteractive/util-string-php/badge.svg)](https://coveralls.io/github/traderinteractive/util-string-php)

[![Latest Stable Version](https://poser.pugx.org/traderinteractive/util-string/v/stable)](https://packagist.org/packages/traderinteractive/util-string)
[![Latest Unstable Version](https://poser.pugx.org/traderinteractive/util-string/v/unstable)](https://packagist.org/packages/traderinteractive/util-string)
[![License](https://poser.pugx.org/traderinteractive/util-string/license)](https://packagist.org/packages/traderinteractive/util-string)

[![Total Downloads](https://poser.pugx.org/traderinteractive/util-string/downloads)](https://packagist.org/packages/traderinteractive/util-string)
[![Daily Downloads](https://poser.pugx.org/traderinteractive/util-string/d/daily)](https://packagist.org/packages/traderinteractive/util-string)
[![Monthly Downloads](https://poser.pugx.org/traderinteractive/util-string/d/monthly)](https://packagist.org/packages/traderinteractive/util-string)

A collection of string utilities.

## Requirements

util-string-php requires PHP 7.0 (or later).

## Composer
To add the library as a local, per-project dependency use [Composer](http://getcomposer.org)! Simply add a dependency on
`traderinteractive/util-string` to your project's `composer.json` file such as:

```json
{
    "require": {
        "traderinteractive/util-string": "^3.0"
    }
}
```
## Documentation
Found in the [source](src) itself, take a look!

## Contact
Developers may be contacted at:

 * [Pull Requests](https://github.com/traderinteractive/util-string-php/pulls)
 * [Issues](https://github.com/traderinteractive/util-string-php/issues)

## Project Build
With a checkout of the code get [Composer](http://getcomposer.org) in your PATH and run:

```sh
./vendor/bin/phpunit
./vendor/bin/phpcs
```

There is also a [docker](http://www.docker.com/)-based
[fig](http://www.fig.sh/) configuration that will execute the build inside a
docker container.  This is an easy way to build the application:
```sh
fig run build
```

## Contributing
For more information on our build process, read through out our [Contribution Guidelines](/.github/CONTRIBUTING.md).
