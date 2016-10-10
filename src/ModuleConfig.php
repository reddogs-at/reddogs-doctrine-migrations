<?php
/**
 * Reddogs (https://github.com/reddogs-at)
 *
 * @see https://github.com/reddogs-at/reddogs-doctrine-migrations for the canonical source repository
 * @license https://github.com/reddogs-at/reddogs-doctrine-migrations/blob/master/LICENSE MIT License
 */
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
                    'handler' => ExecuteCommand::class,
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
                    'handler' => MigrateCommand::class,
                ],
                'mogrations:latest' => [
                    'name' => 'mogrations:latest',
                    'route' => 'mogrations:latest <moduleName>',
                    'handler' => LatestCommand::class,
                ],
                'mogrations:status' => [
                    'name' => 'mogrations:status',
                    'route' => 'mogrations:status <moduleName>',
                    'handler' => StatusCommand::class,
                ],
            ],
            'dependencies' => [
                'factories' => [
                    ExecuteCommand::class => CommandFactory::class,
                    GenerateCommand::class => CommandFactory::class,
                    LatestCommand::class => CommandFactory::class,
                    MigrateCommand::class => CommandFactory::class,
                    StatusCommand::class => CommandFactory::class,
                ]
            ]
        ];
    }
}

