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
                    'short_description' => 'Execute single module migration up or down',
                ],

                'mogrations:generate' =>  [
                    'name' => 'mogrations:generate',
                    'route' => 'mogrations:generate <moduleName> [--quiet|-q] [--no-interaction|-n] [--verbose|-v|-vv|-vvv]',
                    'short_description' => 'Generate new blank module migration class',
                    'handler' => GenerateCommand::class,
                ],
                'mogrations:latest' => [
                    'name' => 'mogrations:latest',
                    'route' => 'mogrations:latest <moduleName>',
                    'handler' => LatestCommand::class,
                    'short_description' => 'Output the latest module migration version number',
                ],
                'mogrations:migrate' =>  [
                    'name' => 'mogrations:migrate',
                    'route' => 'mogrations:migrate <moduleName> [--version=] [--dry-run] [--write-sql] [--query-time] ' .
                               '[--quiet|-q] [--no-interaction|-n] [--verbose|-v|-vv|-vvv]',
                    'short_description' => 'Execute a module migration to a specified version or the latest available version',
                    'handler' => MigrateCommand::class,
                ],
                'mogrations:migrate-all' => [
                    'name' => 'mogrations:migrate-all',
                    'route' => 'mogrations:migrate-all',
                    'short_description' => 'Migrate all registered module migrations',
                    'handler' => MigrateAllCommand::class,
                ],
                'mogrations:status' => [
                    'name' => 'mogrations:status',
                    'route' => 'mogrations:status <moduleName>',
                    'handler' => StatusCommand::class,
                    'short_description' => 'View the status of a set of module migrations'
                ],
            ],
            'dependencies' => [
                'factories' => [
                    ExecuteCommand::class => CommandFactory::class,
                    GenerateCommand::class => CommandFactory::class,
                    LatestCommand::class => CommandFactory::class,
                    MigrateCommand::class => CommandFactory::class,
                    MigrateAllCommand::class => MigrateAllCommandFactory::class,
                    StatusCommand::class => CommandFactory::class,
                ]
            ]
        ];
    }
}

