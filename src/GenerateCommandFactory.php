<?php

namespace Reddogs\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand;

class GenerateCommandFactory extends AbstractCommandFactory
{
    /**
     * Command class
     * @var string
     */
    protected $commandClass = GenerateCommand::class;

    /**
     * Get command class
     *
     * @return string
     */
    public function getCommandClass()
    {
        return $this->commandClass;
    }

    /**
     * Get migrations command
     *
     * @return \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand
     */
    public function getMigrationsCommand()
    {
        return new GenerateCommand();
    }
}