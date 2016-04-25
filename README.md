**oprudkyi/codeception-events-scripting** The [Codeception](http://codeception.com/) extension 
for automatically running shell scripts on codeception events.

[![Latest Stable Version](https://poser.pugx.org/oprudkyi/codeception-events-scripting/v/stable)](https://packagist.org/packages/oprudkyi/codeception-events-scripting) 
[![Total Downloads](https://poser.pugx.org/oprudkyi/codeception-events-scripting/downloads)](https://packagist.org/packages/oprudkyi/codeception-events-scripting) 
[![License](https://poser.pugx.org/oprudkyi/codeception-events-scripting/license)](https://packagist.org/packages/oprudkyi/codeception-events-scripting)

## About

Run shell scripts on codeception's events (like db seeding, stopping-running additional software etc.
Inspired by [Phantoman](https://github.com/site5/phantoman) extension for [Codeception](http://codeception.com/), though allow to run anything in more generic way. 

## Minimum Requirements

- Codeception 2.1.0
- PHP 5.5

## Installation

This project can be installed via [Composer](http://getcomposer.org).
To get the latest version, simply add the following line to
the require block of your composer.json file:

    {
        "require-dev": {
                "oprudkyi/codeception-events-scripting": "*"
        }

    }

You'll then need to run `composer install` or `composer update` to download the
package and have the autoloader updated.

Or run the following command:

```sh
    composer require oprudkyi/codeception-events-scripting --dev
```


## Configuration



## Contribute

This package is (yet) under development and refactoring but is ready for
production. Please, feel free to comment, contribute and help. I will be happy
to get some help to deliver tests.

## License

Codeception's events scripting is licensed under [The MIT License (MIT)](LICENSE).
