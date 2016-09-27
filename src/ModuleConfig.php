<?php

namespace Reddogs\Doctrine\Migrations;

class ModuleConfig
{
    public function __invoke()
    {
        return [
            'console_routes' => [
                [
                    'name' => 'mogrations:generate',
                    'route' => 'mogrations:generate <moduleName>',
                    'description' => 'test route for testing purposes',
                    'short_description' => 'test route',
                    'handler' => GenerateCommand::class,
                ],
            ],
        ];
    }
}