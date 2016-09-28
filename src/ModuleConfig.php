<?php

namespace Reddogs\Doctrine\Migrations;

class ModuleConfig
{
    public function __invoke()
    {
        return [
            'console_routes' => [
                'mogrations:generate' =>  [
                    'name' => 'mogrations:generate',
                    'route' => 'mogrations:generate <moduleName>',
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
            ],
        ];
    }
}

