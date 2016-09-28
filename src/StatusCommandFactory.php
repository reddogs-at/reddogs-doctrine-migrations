<?php

namespace Reddogs\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand as MigrationsStatusCommand;
use Reddogs\Doctrine\Migrations\StatusCommand;

class StatusCommandFactory extends AbstractCommandFactory
{
    /**
     * Command class
     * @var string
     */
    protected $commandClass = StatusCommand::class;

    /**
     * Get migrations command
     *
     * @return \Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand
     */
    public function getMigrationsCommand()
    {
        return new MigrationsStatusCommand();
    }
}