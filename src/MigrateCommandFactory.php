<?php

namespace Reddogs\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand as MigrationsMigrateCommand;
use Reddogs\Doctrine\Migrations\MigrateCommand;

class MigrateCommandFactory extends AbstractCommandFactory
{
    /**
     * Command class
     * @var string
     */
    protected $commandClass = MigrateCommand::class;

    /**
     * Get migrations command
     *
     * @return \Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand
     */
    public function getMigrationsCommand()
    {
        return new MigrationsMigrateCommand();
    }
}