# util-string-php
[![Build Status](https://travis-ci.org/traderinteractive/util-string-php.svg?branch=master)](https://travis-ci.org/traderinteractive/util-string-php)
[![Scrutinizer Code Quality](http://img.shields.io/scrutinizer/g/traderinteractive/util-string-php.svg?style=flat)](https://scrutinizer-ci.com/g/traderinteractive/util-string-php/)
[![Coverage Status](https://coveralls.io/repos/traderinteractive/util-string-php/badge.svg?branch=master&service=github)](https://coveralls.io/github/traderinteractive/util-string-php?branch=master)

[![Latest Stable Version](http://img.shields.io/packagist/v/traderinteractive/util-string.svg?style=flat)](https://packagist.org/packages/traderinteractive/util-string)
[![Total Downloads](http://img.shields.io/packagist/dt/traderinteractive/util-string.svg?style=flat)](https://packagist.org/packages/traderinteractive/util-string)
[![License](http://img.shields.io/packagist/l/traderinteractive/util-string.svg?style=flat)](https://packagist.org/packages/traderinteractive/util-string)

A collection of string utilities.

## Requirements

util-string-php requires PHP 5.4 (or later).

##Composer
To add the library as a local, per-project dependency use [Composer](http://getcomposer.org)! Simply add a dependency on
`traderinteractive/util-string` to your project's `composer.json` file such as:

```json
{
    "require": {
        "traderinteractive/util-string": "^3.0"
    }
}
```
##Documentation
Found in the [source](src) itself, take a look!

##Contact
Developers may be contacted at:

 * [Pull Requests](https://github.com/traderinteractive/util-string-php/pulls)
 * [Issues](https://github.com/traderinteractive/util-string-php/issues)

##Project Build
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

For more information on our build process, read through out our [Contribution Guidelines](CONTRIBUTING.md).
