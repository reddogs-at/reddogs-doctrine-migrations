<?php

namespace Reddogs\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand as MigrationsExecuteCommand;
use Reddogs\Doctrine\Migrations\ExecuteCommand;

class ExecuteCommandFactory extends AbstractCommandFactory
{
    /**
     * Command class
     * @var string
     */
    protected $commandClass = ExecuteCommand::class;

    /**
     * Get migrations command
     *
     * @return \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand
     */
    public function getMigrationsCommand()
    {
        return new MigrationsExecuteCommand();
    }
}