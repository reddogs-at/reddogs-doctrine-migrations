<?php

namespace Reddogs\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\Tools\Console\Command\LatestCommand as MigrationsLatestCommand;
use Reddogs\Doctrine\Migrations\LatestCommand;

class LatestCommandFactory extends AbstractCommandFactory
{
    /**
     * Command class
     * @var string
     */
    protected $commandClass = LatestCommand::class;

    /**
     * Get migrations command
     *
     * @return \Doctrine\DBAL\Migrations\Tools\Console\Command\LatestCommand
     */
    public function getMigrationsCommand()
    {
        return new MigrationsLatestCommand();
    }
}