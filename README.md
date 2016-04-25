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

Enable extension in the codeception.yml and write commands. 
Next events are supported:
- BeforeAll - run before tests on every "codecept run"
- AfterAll - run after all tests
- BeforeSuite - run before each suite (use 'suites' array to run only for selected suites)
- AfterSuite - run after each suite (use 'suites' array to run only for selected suites)

supported next attributes:
- command - command line to run (for one-liners you can write command directly)
- description - echoed before command
- params - additional params for command
- ignoreErrors - don't break testing if command fails (failed or retval > 0) 
- suites - single name or array of suites to run command for


```yml
extensions:
    enabled:
        - Codeception\Extension\EventsScripting
    config:
        Codeception\Extension\EventsScripting:
            BeforeAll:
                - command: echo "Before All"
                - command: echo "Before All with Description"
                  description: Description of command
                - echo "Before All single line"
                - command: echo 
                  params: "Before All Params"
                  description: Before All with Params
                - command: "false"
                  description: BeforeAll. fail on run but ignore errors
                  ignoreErrors: true
            AfterAll:
                - command: echo "After All"
            BeforeSuite:
                - command: echo "Before acceptance suite"
                  suites: ['acceptance']
                - command: echo "Before any suite"
            AfterSuite:
                - command: echo "After acceptance suite"
                  suites: 'acceptance'
                - command: echo "After any suite"

```

## Contribute

This package is (yet) under development and refactoring but is ready for
production. Please, feel free to comment, contribute and help. I will be happy
to get some help to deliver tests.

## License

Codeception's events scripting is licensed under [The MIT License (MIT)](LICENSE).
