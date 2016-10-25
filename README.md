# Module specific doctrine migrations 

[![Build Status](https://travis-ci.org/reddogs-at/reddogs-doctrine-migrations.svg?branch=master)](https://travis-ci.org/reddogs-at/reddogs-doctrine-migrations)
[![Coverage Status](https://coveralls.io/repos/reddogs-at/reddogs-doctrine-migrations/badge.svg?branch=master&service=github)](https://coveralls.io/github/reddogs-at/reddogs-doctrine-migrations?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/reddogs-at/reddogs-doctrine-migrations/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/reddogs-at/reddogs-doctrine-migrations/?branch=master)
[![Code Climate](https://codeclimate.com/github/reddogs-at/reddogs-doctrine-migrations/badges/gpa.svg)](https://codeclimate.com/github/reddogs-at/reddogs-doctrine-migrations)

Module specific doctrine migrations

## Installation

    composer require reddogs-at/reddogs-doctrine-migrations

## Configuration

I recommend [Building Modular Applications](https://docs.zendframework.com/zend-expressive/cookbook/modular-layout/) with [Zend Expressive](https://docs.zendframework.com/zend-expressive) 

Create a file `ModuleConfig.php` in your module source path. (e.g. `module/YourModule/src`) or add config 
key `reddogs_doctrine_migrations` to existing configuration: 

```php
<?php

namespace YourModule;

class ModuleConfig
{
    public function __invoke()
    {
        return [
            'doctrine' => [
                'reddogs_doctrine_migrations' => [
                    'your_module' => [
                        'namespace' => 'YourModule',
                        'directory' => dirname(__DIR__) . '/data/migrations',
                        'table_name' => 'your_module_migrations'
                    ]
                ]
            ]
        ];
    }
}

```

### Configuration Options

(see section [Custom Configuration](http://docs.doctrine-project.org/projects/doctrine-migrations/en/latest/reference/custom_configuration.html)
of [Doctrine Migrations](http://docs.doctrine-project.org/projects/doctrine-migrations) documentation)

* `namespace`: your module namespace
* `directory`: path to migration classes
* `table_name`: name of the module migration table

## Usage

### Execute single module migration up or down

* Simple: `/path/to/script.php mogrations:execute <moduleName> [--version=]`
* All paramenters: `/path/to/script.php mogrations:execute <moduleName> [--version=] [--write-sql] [--dry-run] [--up] [--down] [--query-time] [--quiet|-q] [--no-interaction|-n] [--verbose|-v|-vv|-vvv]`


### Generate new blank module migration class

* Simple: `/path/to/script.php mogrations:generate <moduleName>`
* All parameters: `mogrations:generate <moduleName> [--quiet|-q] [--no-interaction|-n] [--verbose|-v|-vv|-vvv]`

### Output the latest module migration version number 
* All parameters: `/path/to/script.php mogrations:latest <moduleName>`

### Execute a module migration to a specified version or the latest available version

* Simple: `/path/to/script.php mogrations:migrate <moduleName>`
* All parameters: `mogrations:migrate <moduleName> [--version=] [--dry-run] [--write-sql] [--query-time] [--quiet|-q] [--no-interaction|-n] [--verbose|-v|-vv|-vvv]`

### Migrate all registered module migrations

* All parameters: `mogrations:migrate-all`

### View the status of a set of module migrations

* All Parameters: `mogrations:status <moduleName>`