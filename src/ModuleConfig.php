<?php

namespace Reddogs\Doctrine\Migrations;

class ModuleConfig
{
    public function __invoke()
    {
        return [
            'console_routes' => [
                'mogrations:execute' => [
                    'name' => 'mogrations:execute',
                    'route' => 'mogrations:execute <moduleName> [--version=] [--write-sql] [--dry-run] [--up] [--down] [--query-time] ' .
                               '[--quiet|-q] [--no-interaction|-n] [--verbose|-v|-vv|-vvv]',
                ],
                'mogrations:generate' =>  [
                    'name' => 'mogrations:generate',
                    'route' => 'mogrations:generate <moduleName> [--quiet|-q] [--no-interaction|-n] [--verbose|-v|-vv|-vvv]',
                    'description' => 'test route for testing purposes',
                    'short_description' => 'test route',
                    'handler' => GenerateCommand::class,
                ],
                'mogrations:migrate' =>  [
                    'name' => 'mogrations:migrate',
                    'route' => 'mogrations:migrate <moduleName> [--version=] [--dry-run] [--write-sql] [--query-time] ' .
                               '[--quiet|-q] [--no-interaction|-n] [--verbose|-v|-vv|-vvv]',
                    'description' => 'test route for testing purposes',
                    'short_description' => 'test route',
                    'handler' => GenerateCommand::class,
                ],
                'mogrations:latest' => [
                    'name' => 'mogrations:latest',
                    'route' => 'mogrations:latest <moduleName>'
                ],
                'mogrations:status' => [
                    'name' => 'mogrations:status',
                    'route' => 'mogrations:status <moduleName>'
                ],
            ],
        ];
    }
}

